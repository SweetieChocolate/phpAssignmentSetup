<?php
// this part is ui framework and seesion validate part

if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['ISINITIALIZE'])) exit();

require_once $_SESSION['PROJECT_ROOTPATH'] . "UIFramework/ui-head.php";

// data manipulate start here

$ddlEmployment = OEmployment::GetAllEmployments($sessionId);

$ddlDeductionType = OCodeField::GetDropDownListCodeFieldByCodeType(OCodeField::$DEDUCTION_TYPE, $sessionId);

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



// pre render logic end here

require_once $_SESSION['PROJECT_ROOTPATH'] . "UIFramework/ui-foot.php";

?>

<html>
<head>
    <?php include $_SESSION['WEB_ROOTPATH'] . "web-header.php"; ?>
</head>
<body class="frame">
    <form id="VIEW" action="" method="post" BaseTableName="Deduction">
        <gridview id="gvDetails" TableName="Deduction">
            <grid-command>
                <command CommandName="AddObject" CommandText="New"></command>
            </grid-command>
            <grid-column>
                <column PropertyName="->Employment->ObjectNumber" HeaderText="Code" />
                <column PropertyName="->Employment->ObjectName" HeaderText="Name" />
                <column PropertyName="->FromMonthText" HeaderText="From Month" />
                <column PropertyName="->ToMonthText" HeaderText="To Month" />
                <column PropertyName="->DeductionType->ObjectName" HeaderText="Deduction Type" />
                <column PropertyName="->Amount" HeaderText="Amount" />
            </grid-column>
        </gridview>
    </form>
    <form id="EDIT" action="" method="post" BaseTableName="Deduction" Save="SaveObject">

        <div class="row">
            <div class="one-col">
                <dropdownlist id="ddlEmployment" name="->EmploymentID" Caption="Employment" Load="ddlEmployment" required="true">
                    <option value=""></option>
                </dropdownlist>
            </div>
        </div>

        <div class="row">
            <div class="two-col">
                <input type="month" id="dtFromMonth" name="->FromMonth" Caption="From Month" required="true" />
            </div>
            <div class="two-col">
                <input type="month" id="dtToMonth" name="->ToMonth" Caption="To Month" />
            </div>
        </div>

        <div class="row">
            <div class="two-col">
                <dropdownlist id="ddlDeductionType" name="->DeductionTypeID" Caption="Deduction Type" Load="ddlDeductionType" required="true">
                    <option value=""></option>
                </dropdownlist>
            </div>
            <div class="two-col">
                <input type="text" id="tbAmount" name="->Amount" Caption="Amount" required="true" />
            </div>
        </div>

    </form>
    <?php include $_SESSION['WEB_ROOTPATH'] . "web-footer.php" ?>
</body>
</html>