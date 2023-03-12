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
    PayrollHelper::GenerateMonthlySalary($o);
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
    <form id="VIEW" action="" method="post" BaseTableName="MonthlySalary">
        <gridview id="gvDetails" TableName="MonthlySalary">
            <grid-command>
                <command CommandName="AddObject" CommandText="New"></command>
            </grid-command>
            <grid-column>
                <column PropertyName="->Employment->ObjectNumber" HeaderText="Code" />
                <column PropertyName="->Employment->ObjectName" HeaderText="Name" />
                <column PropertyName="->InMonthText" HeaderText="In Month" />
                <column PropertyName="->FromDateText" HeaderText="From Date" />
                <column PropertyName="->ToDateText" HeaderText="To Date" />
                <column PropertyName="->BasicSalaryEarned" HeaderText="Basic Salary Earned" />
                <column PropertyName="->AllowanceAmount" HeaderText="Allowance" />
                <column PropertyName="->BonusAmount" HeaderText="Bonus" />
                <column PropertyName="->DeductionAmount" HeaderText="Deduction" />
                <column PropertyName="->TaxAmount" HeaderText="Tax" />
                <column PropertyName="->SalaryAmount" HeaderText="Salary" />
            </grid-column>
        </gridview>
    </form>
    <form id="EDIT" action="" method="post" BaseTableName="MonthlySalary" Save="SaveObject">
        <button id="btnGenerate" type="submit" class="btn btn-primary" name="BUTTON" value="Generate">Generate</button>

        <div class="row">
            <div class="one-col">
                <dropdownlist id="ddlEmployment" name="->EmploymentID" Caption="Employment" Load="ddlEmployment" required="true">
                    <option value=""></option>
                </dropdownlist>
            </div>
        </div>

        <div class="row">
            <div class="two-col">
                <input type="month" id="dtInMonth" name="->InMonth" Caption="In Month" required="true"
                    onchange="this.form.submit()" />
            </div>
            <div class="two-col">
                <input type="text" id="tbExchangeRate" name="->ExchangeRate" Caption="Exchange Rate" required="true" />
            </div>
        </div>

        <div class="row">
            <div class="two-col">
                <input type="date" id="dtFromDate" name="->FromDate" Caption="From Date" required="true" />
            </div>
            <div class="two-col">
                <input type="date" id="dtToDate" name="->ToDate" Caption="To Date" required="true" />
            </div>
        </div>

        <div class="row">
            <div class="two-col">
                <input type="text" id="tbBasicSalary" name="->BasicSalaryEarned" Caption="Basic Salary" readonly="true" />
            </div>
            <div class="two-col">
                <input type="text" id="tbDeduction" name="->DeductionAmount" Caption="Deduction" readonly="true" />
            </div>
        </div>

        <div class="row">
            <div class="two-col">
                <input type="text" id="tbAllowance" name="->AllowanceAmount" Caption="Allowance" readonly="true" />
            </div>
            <div class="two-col">
                <input type="text" id="tbTax" name="->TaxAmount" Caption="Tax Amount" readonly="true" />
            </div>
        </div>

        <div class="row">
            <div class="two-col">
                <input type="text" id="tbBonus" name="->BonusAmount" Caption="Bonus" readonly="true" />
            </div>
            <div class="two-col">
                <input type="text" id="tbSalary" name="->SalaryAmount" Caption="Salary" readonly="true" />
            </div>
        </div>

        <div class="row">
            <div class="one-col">
                <textarea id="tbMessage" name="->GenerateMessage" Caption="Generate Message" readonly="true" style="width: 500px"></textarea>
            </div>
        </div>

        <br/><br/>
        <div class="row">
            <div class="two-col">
                <onetomany PropertyName="->MonthlySalaryAllowances" EnableEdit="false" EnableDelete="false">
                    <grid-column>
                        <column PropertyName="->AllowanceType->ObjectName" HeaderText="Allowance Type" />
                        <column PropertyName="->Amount" HeaderText="Amount"/>
                    </grid-column>
                </onetomany>
            </div>
        </div>
        
        <br/><br/>
        <div class="row">           
            <div class="two-col">
                <onetomany PropertyName="->MonthlySalaryBonuses" EnableEdit="false" EnableDelete="false">
                    <grid-column>
                        <column PropertyName="->BonusType->ObjectName" HeaderText="Bonus Type" />
                        <column PropertyName="->Amount" HeaderText="Amount"/>
                    </grid-column>
                </onetomany>
            </div>
        </div>
        
        <br/><br/>
        <div class="row">
            <div class="two-col">
                <onetomany PropertyName="->MonthlySalaryDeductions" EnableEdit="false" EnableDelete="false">
                    <grid-column>
                        <column PropertyName="->DeductionType->ObjectName" HeaderText="Deduction Type" />
                        <column PropertyName="->Amount" HeaderText="Amount"/>
                    </grid-column>
                </onetomany>
            </div>
        </div>

    </form>
    <?php include $_SESSION['WEB_ROOTPATH'] . "web-footer.php" ?>
</body>
</html>