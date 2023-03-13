<?php
// this part is ui framework and seesion validate part

if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['ISINITIALIZE'])) exit();

require_once $_SESSION['PROJECT_ROOTPATH'] . "UIFramework/ui-head.php";

// data manipulate start here

$ddlEmployment = OEmployment::GetAllEmployments($sessionId);

// data manupulate end here

// function start here

function SaveObject()
{
    $o = BindFormToObject();
    $con = new DBConnection();
    $o->save($con);
    $con->commit();
    BindObjectToForm($o);
}

// function end here

require_once $_SESSION['PROJECT_ROOTPATH'] . "UIFramework/ui-handle.php";

// pre render logic start here

$o = GetCurrentObject();
if ($o != null && $o->InMonth !== null && ($o->FromDate === null || $o->ToDate === null))
{
    $o->FromDate = DateTimeHelper::GetMonthStart($o->InMonth);
    $o->ToDate = DateTimeHelper::GetMonthEnd($o->InMonth);
    BindObjectToForm($o);
}

if ($ButtonName == "Generate")
{
    $con = new DBConnection();
    foreach ($o->MonthlySalaries as $item)
    {
        $item->InMonth = $o->InMonth;
        $item->FromDate = $o->FromDate;
        $item->ToDate = $o->ToDate;
        $item->ExchangeRate = $o->ExchangeRate;
        PayrollHelper::GenerateMonthlySalary($item);
    }
    $o->save($con);
    $con->commit();
    BindObjectToForm($o);
}

// pre render logic end here

require_once $_SESSION['PROJECT_ROOTPATH'] . "UIFramework/ui-foot.php";

?>

<html>
<head>
    <?php include $_SESSION['WEB_ROOTPATH'] . "web-header.php"; ?>
</head>
<body class="frame">
    <form id="VIEW" action="" method="post" BaseTableName="MonthlySalaryGenerate">
        <gridview id="gvDetails" TableName="MonthlySalaryGenerate">
            <grid-command>
                <command CommandName="AddObject" CommandText="New"></command>
            </grid-command>
            <grid-column>
                <column PropertyName="->InMonthText" HeaderText="In Month" />
                <column PropertyName="->FromDateText" HeaderText="From Date" />
                <column PropertyName="->ToDateText" HeaderText="To Date" />
                <column PropertyName="->TotalEmployment" HeaderText="Total Employment" />
                <column PropertyName="->TotalBasicSalary" HeaderText="Total Basic Salary" />
                <column PropertyName="->TotalAllowance" HeaderText="Total Allowance" />
                <column PropertyName="->TotalBonus" HeaderText="Total Bonus" />
                <column PropertyName="->TotalDeduction" HeaderText="Total Deduction" />
                <column PropertyName="->TotalTax" HeaderText="Total Tax" />
                <column PropertyName="->TotalSalary" HeaderText="Total Salary" />
            </grid-column>
        </gridview>
    </form>
    <form id="EDIT" action="" method="post" BaseTableName="MonthlySalaryGenerate" Save="SaveObject">
        <button id="btnGenerate" type="submit" class="btn btn-primary" name="BUTTON" value="Generate">Generate</button>
        
        <div class="row">
            <div class="one-col">
                <input type="month" id="dtInMonth" name="->InMonth" Caption="In Month" required="true"
                    onchange="this.form.submit()" />
            </div>
        </div>

        <div class="row">
            <div class="one-col">
                <input type="date" id="dtFromDate" name="->FromDate" Caption="From Date" required="true" />
            </div>
        </div>

        <div class="row">
            <div class="one-col">
                <input type="date" id="dtToDate" name="->ToDate" Caption="To Date" required="true" />
            </div>
        </div>

        <div class="row">
            <div class="one-col">
                <input type="text" id="tbExchangeRate" name="->ExchangeRate" Caption="Exchange Rate" required="true" />
            </div>
        </div>

        <div class="row">
            <div class="one-col">
                <onetomany PropertyName="->MonthlySalaries" ExportExcel="true">
                    <grid-command>
                        <command CommandName="AddObject" CommandText="New"></command>
                    </grid-command>
                    <grid-column>
                        <column PropertyName="->Employment->ObjectNumber" HeaderText="Code" />
                        <column PropertyName="->Employment->ObjectName" HeaderText="Name"/>
                        <column PropertyName="->BasicSalaryEarned" HeaderText="Basic Salary Earned"/>
                        <column PropertyName="->AllowanceAmount" HeaderText="Allowance"/>
                        <column PropertyName="->BonusAmount" HeaderText="Bonus"/>
                        <column PropertyName="->DeductionAmount" HeaderText="Deduction"/>
                        <column PropertyName="->AmountToBeTax" HeaderText="Taxable Amount"/>
                        <column PropertyName="->TaxAmount" HeaderText="Tax Amount"/>
                        <column PropertyName="->SalaryAmount" HeaderText="Salary"/>
                        <column PropertyName="->GenerateMessage" HeaderText="Message"/>
                    </grid-column>
                    <pop-up Size="modal-lg" Caption="Employment">
                        <dropdownlist id="ddlEmployment" name="->EmploymentID" Caption="Employment" Load="ddlEmployment" required="true" />
                    </pop-up>
                </onetomany>
            </div>
        </div>

    </form>
    <?php include $_SESSION['WEB_ROOTPATH'] . "web-footer.php" ?>
</body>
</html>