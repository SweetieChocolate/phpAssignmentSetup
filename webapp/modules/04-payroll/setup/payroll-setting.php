
<?php
// this part is ui framework and seesion validate part

if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['ISINITIALIZE'])) exit();

require_once $_SESSION['PROJECT_ROOTPATH'] . "UIFramework/ui-head.php";

// data manipulate start here


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
    <form id="VIEW" action="" method="post" BaseTableName="PayrollSetting">
        <?php
            //require_once $_SESSION['PROJECT_ROOTPATH'] . "LogicLayer/LogicLayer.php";
            $redirectURL = $_requestURI . "?ACTION=EDIT&DATAKEY=" . urlencode(OPayrollSetting::Current()->ObjectID->Encrypt($sessionId));
            header("Location: $redirectURL");
        ?>
    </form>
    <form id="EDIT" action="" method="post" BaseTableName="PayrollSetting" Save="SaveObject">
        <div class="row">
            <div class="two-col">
                <onetomany PropertyName="->TaxContributions">
                    <grid-command>
                        <command CommandName="AddObject" CommandText="New"></command>
                    </grid-command>
                    <grid-column>
                        <column PropertyName="->FromAmount" HeaderText="From" />
                        <column PropertyName="->ToAmount" HeaderText="To" />
                        <column PropertyName="->TaxRate" HeaderText="Rate" />
                        <column PropertyName="->CumulativeDeduction" HeaderText="Cumulative Deduction" />
                    </grid-column>
                    <pop-up Size="modal-lg" Caption="Contribution">
                        <input type="text" id="tbFromAmount" name="->FromAmount" Caption="From" required="true" />
                        <input type="text" id="tbToAmount" name="->ToAmount" Caption="To" required="true" />
                        <input type="text" id="tbRate" name="->TaxRate" Caption="Rate" required="true" />
                        <input type="text" id="tbCumulative" name="->CumulativeDeduction" Caption="Cumulative Deduction" required="true" />
                    </pop-up>
                </onetomany>
            </div>
        </div>
    </form>
    <?php include $_SESSION['WEB_ROOTPATH'] . "web-footer.php" ?>
</body>
</html>