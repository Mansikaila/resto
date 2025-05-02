<?php  
include_once(__DIR__ . "/../config/connection.php");
class mdl_customerwiseitempreservationpricelistmaster 
{                        
public $_customer_wise_item_preservation_price_list_id;          
    public $_customer_id;          
    public $_item_id;          
    public $_packing_unit_id;          
    public $_rent_kg_per_month;          
    public $_season_rent_per_kg;          
    public $_created_date;          
    public $_created_by;          
    public $_modified_date;          
    public $_modified_by;          
    public $_company_id;          
    public $_transactionmode;
    
}
class bll_customerwiseitempreservationpricelistmaster                           
{   
    public $_mdl;
    public $_dal;

    public function __construct()    
    {
        $this->_mdl =new mdl_customerwiseitempreservationpricelistmaster(); 
        $this->_dal =new dal_customerwiseitempreservationpricelistmaster();
    }

    public function dbTransaction()
    {
        $this->_dal->dbTransaction($this->_mdl);  
       if($this->_mdl->_transactionmode =="D")
       {
            header("Location:../srh_customer_wise_item_preservation_price_list_master.php");
       }
       if($this->_mdl->_transactionmode =="U")
       {
            header("Location:../srh_customer_wise_item_preservation_price_list_master.php");
       }
       if($this->_mdl->_transactionmode =="I")
       {
            header("Location:../frm_customer_wise_item_preservation_price_list_master.php");
       }

    }
    public function fillModel()
    {
        global $_dbh;
        $this->_dal->fillModel($this->_mdl);
    
    
    }
     public function pageSearch()
    {
        global $_dbh;

        $sql="CAll csms1_search('t1.customer, t1.customer, t2.item_name, t.customer_wise_item_preservation_price_list_id','tbl_customer_wise_item_preservation_price_list_master t INNER JOIN tbl_customer_master t1 ON t.customer_id=t1.customer_id INNER JOIN tbl_item_master t2 ON t.item_id=t2.item_id')";
        echo "
        <table  id=\"searchMaster\" class=\"ui celled table display\">
        <thead>
            <tr>
            <th>Action</th> 
            <th> Customer  <br><input type=\"text\" data-index=\"1\" placeholder=\"Search Customer \" /></th> 
                         <th> Item  <br><input type=\"text\" data-index=\"2\" placeholder=\"Search Item \" /></th> 
                         </tr>
        </thead>
        <tbody>";
         $_grid="";
         $j=0;
        foreach($_dbh-> query($sql) as $_rs)
        {
            $j++;
        
        $_grid.="<tr>
        <td> 
            <form  method=\"post\" action=\"frm_customer_wise_item_preservation_price_list_master.php\" style=\"display:inline; margin-rigth:5px;\">
            <i class=\"fa fa-edit update\" style=\"cursor: pointer;\"></i>
            <input type=\"hidden\" name=\"customer_wise_item_preservation_price_list_id\" value=\"".$_rs["customer_wise_item_preservation_price_list_id"]."\" />
            <input type=\"hidden\" name=\"transactionmode\" value=\"U\"  />
            </form> <form  method=\"post\" action=\"classes/cls_customer_wise_item_preservation_price_list_master.php\" style=\"display:inline;\">
            <i class=\"fa fa-trash delete\" style=\"cursor: pointer;\"></i>
            <input type=\"hidden\" name=\"customer_wise_item_preservation_price_list_id\" value=\"".$_rs["customer_wise_item_preservation_price_list_id"]."\" />
            <input type=\"hidden\" name=\"transactionmode\" value=\"D\"  />
            </form>
            </td>";
        $fieldvalue=$_rs["customer"];
                            $_grid.= "
                            <td> ".$fieldvalue." </td>"; 
                       $fieldvalue=$_rs["item_name"];
                            $_grid.= "
                            <td> ".$fieldvalue." </td>"; 
                       $_grid.= "</tr>\n";
           
            
        }   
         if($j==0) {
                $_grid.= "<tr>";
                $_grid.="<td colspan=\"10\">No records available.</td>";
                $_grid.="<td style=\"display:none\">&nbsp;</td>";
                         $_grid.="<td style=\"display:none\">&nbsp;</td>";
                         $_grid.="</tr>";
            }
        $_grid.="</tbody>
        </table> ";
        echo $_grid; 
    }
    function checkDuplicate($column_name,$column_value,$id_name,$id_value,$table_name) {
        global $_dbh;
        try {
            $sql="CAll csms1_check_duplicate('".$column_name."','".$column_value."','".$id_name."','".$id_value."','".$table_name."',@is_duplicate)";
            $stmt=$_dbh->prepare($sql);
            $stmt->execute();
            $result = $_dbh->query("SELECT @is_duplicate");
            $is_default = $result->fetchColumn();
            return $is_default;
        }
        catch (PDOException $e) {
            //echo "Error: " . $e->getMessage();
            return 0;
        }
        return 0;
    }
}
 class dal_customerwiseitempreservationpricelistmaster                         
{
    public function dbTransaction($_mdl)                     
    {
        global $_dbh;

        
        $_dbh->exec("set @p0 = ".$_mdl->_customer_wise_item_preservation_price_list_id);
        $_pre=$_dbh->prepare("CALL customer_wise_item_preservation_price_list_master_transaction (@p0,?,?,?,?,?,?,?,?,?,?,?) ");
        $_pre->bindParam(1,$_mdl->_customer_id);
        $_pre->bindParam(2,$_mdl->_item_id);
        $_pre->bindParam(3,$_mdl->_packing_unit_id);
        $_pre->bindParam(4,$_mdl->_rent_kg_per_month);
        $_pre->bindParam(5,$_mdl->_season_rent_per_kg);
        $_pre->bindParam(6,$_mdl->_created_date);
        $_pre->bindParam(7,$_mdl->_created_by);
        $_pre->bindParam(8,$_mdl->_modified_date);
        $_pre->bindParam(9,$_mdl->_modified_by);
        $_pre->bindParam(10,$_mdl->_company_id);
        $_pre->bindParam(11,$_mdl->_transactionmode);
        $_pre->execute();
        
    }
    public function fillModel($_mdl)
    {
        global $_dbh;
        $_pre=$_dbh->prepare("CALL customer_wise_item_preservation_price_list_master_fillmodel (?) ");
        $_pre->bindParam(1,$_REQUEST["customer_wise_item_preservation_price_list_id"]);
        $_pre->execute();
        $_rs=$_pre->fetchAll(); 
        if(!empty($_rs)) {

        $_mdl->_customer_wise_item_preservation_price_list_id=$_rs[0]["customer_wise_item_preservation_price_list_id"];
        $_mdl->_customer_id=$_rs[0]["customer_id"];
        $_mdl->_item_id=$_rs[0]["item_id"];
        $_mdl->_packing_unit_id=$_rs[0]["packing_unit_id"];
        $_mdl->_rent_kg_per_month=$_rs[0]["rent_kg_per_month"];
        $_mdl->_season_rent_per_kg=$_rs[0]["season_rent_per_kg"];
        $_mdl->_created_date=$_rs[0]["created_date"];
        $_mdl->_created_by=$_rs[0]["created_by"];
        $_mdl->_modified_date=$_rs[0]["modified_date"];
        $_mdl->_modified_by=$_rs[0]["modified_by"];
        $_mdl->_company_id=$_rs[0]["company_id"];
        $_mdl->_transactionmode =$_REQUEST["transactionmode"];
        }
    }
public function fetchPackingUnits($item_id)
{
    global $_dbh;

    try {
       $stmt = $_dbh->prepare("
    SELECT 
        pum.packing_unit_id, 
        pum.packing_unit_name, 
        COALESCE(ippl.rent_kg_per_month, '0.00') AS rent_kg_per_month, 
        COALESCE(ippl.season_rent_per_kg, '0.00') AS season_rent_per_kg
    FROM tbl_packing_unit_master pum
    LEFT JOIN tbl_customer_wise_item_preservation_price_list_master ippl 
        ON pum.packing_unit_id = ippl.packing_unit_id
    WHERE (ippl.item_id = :item_id OR ippl.item_id IS NULL)
      AND pum.status
      = 1");

        $stmt->bindParam(':item_id', $item_id, PDO::PARAM_INT);
        $stmt->execute();
        
        $packingUnits = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $packingUnits ?: [];

    } catch (PDOException $e) {
        error_log("Database Error (fetchPackingUnits): " . $e->getMessage());
        return ['error' => 'Error fetching data.'];
    }
}

   public function savePackingUnits($data)
{
    global $_dbh;

    $packing_unit_id = $data['packing_unit_id'];
    $item_id = $data['item_id'];
    $rent_kg_per_month = $data['rent_kg_per_month'];
    $season_rent_per_kg = $data['season_rent_per_kg'];

    try {
        // Update or Insert into item_preservation_price_list_master
        $checkQuery = "
            SELECT COUNT(*) 
            FROM tbl_item_preservation_price_list_master 
            WHERE packing_unit_id = :packing_unit_id AND item_id = :item_id
        ";
        $checkStmt = $_dbh->prepare($checkQuery);
        $checkStmt->bindParam(':packing_unit_id', $packing_unit_id, PDO::PARAM_INT);
        $checkStmt->bindParam(':item_id', $item_id, PDO::PARAM_INT);
        $checkStmt->execute();
        $recordExists = $checkStmt->fetchColumn();

        if ($recordExists) {
            $updateQuery = "
                UPDATE tbl_item_preservation_price_list_master
                SET rent_kg_per_month = :rent_kg_per_month,
                    season_rent_per_kg = :season_rent_per_kg
                WHERE packing_unit_id = :packing_unit_id AND item_id = :item_id
            ";
            $stmt = $_dbh->prepare($updateQuery);
        } else {
            $insertQuery = "
                INSERT INTO tbl_item_preservation_price_list_master 
                (packing_unit_id, item_id, rent_kg_per_month, season_rent_per_kg)
                VALUES (:packing_unit_id, :item_id, :rent_kg_per_month, :season_rent_per_kg)
            ";
            $stmt = $_dbh->prepare($insertQuery);
        }

        $stmt->bindParam(':packing_unit_id', $packing_unit_id, PDO::PARAM_INT);
        $stmt->bindParam(':item_id', $item_id, PDO::PARAM_INT);
        $stmt->bindParam(':rent_kg_per_month', $rent_kg_per_month, PDO::PARAM_STR);
        $stmt->bindParam(':season_rent_per_kg', $season_rent_per_kg, PDO::PARAM_STR);
        $stmt->execute();

        // Update corresponding records in customer_wise_item_preservation_price_list_master
        $updateCustomerWiseQuery = "
            UPDATE tbl_customer_wise_item_preservation_price_list_master
            SET rent_kg_per_month = :rent_kg_per_month,
                season_rent_per_kg = :season_rent_per_kg
            WHERE packing_unit_id = :packing_unit_id AND item_id = :item_id
        ";
        $customerStmt = $_dbh->prepare($updateCustomerWiseQuery);
        $customerStmt->bindParam(':packing_unit_id', $packing_unit_id, PDO::PARAM_INT);
        $customerStmt->bindParam(':item_id', $item_id, PDO::PARAM_INT);
        $customerStmt->bindParam(':rent_kg_per_month', $rent_kg_per_month, PDO::PARAM_STR);
        $customerStmt->bindParam(':season_rent_per_kg', $season_rent_per_kg, PDO::PARAM_STR);
        $customerStmt->execute();

        return ['success' => true];

    } catch (PDOException $e) {
        error_log("Database Error (savePackingUnits): " . $e->getMessage());
        return ['error' => 'Error updating data.'];
    }
}

}
$_bll=new bll_customerwiseitempreservationpricelistmaster();
if (isset($_REQUEST["action"]) && $_REQUEST["action"] == "fetch_units") {
    $item_id = isset($_GET["item_id"]) ? intval($_GET["item_id"]) : 0;

    if ($item_id > 0) {
        $dal = new dal_customerwiseitempreservationpricelistmaster();
        $packingUnits = $dal->fetchPackingUnits($item_id);

        if (isset($packingUnits['error'])) {
            echo json_encode([]);
        } else {
            echo json_encode($packingUnits);
        }
    } else {
        echo json_encode([]);
    }
    exit;
}
if(isset($_REQUEST["action"]))
{
    $action=$_REQUEST["action"];
    $_bll->$action();
}
if(isset($_POST["type"]) && $_POST["type"]=="ajax") {
    $column_name="";$column_value="";$id_name="";$id_value="";$table_name="";
    if(isset($_POST["column_name"]))
        $column_name=$_POST["column_name"];
    if(isset($_POST["column_value"]))
        $column_value=$_POST["column_value"];
    if(isset($_POST["id_name"]))
        $id_name=$_POST["id_name"];
    if(isset($_POST["id_value"]))
        $id_value=$_POST["id_value"];
    if(isset($_POST["table_name"]))
        $table_name=$_POST["table_name"];
    echo $_bll->checkDuplicate($column_name,$column_value,$id_name,$id_value,$table_name);
    exit;
}
if(isset($_POST["masterHidden"]) && ($_POST["masterHidden"]=="save"))
{
 
            
            if(isset($_REQUEST["customer_wise_item_preservation_price_list_id"]) && !empty($_REQUEST["customer_wise_item_preservation_price_list_id"]))
                $field=trim($_REQUEST["customer_wise_item_preservation_price_list_id"]);
            else {
                    $field=0;
           }
    $_bll->_mdl->_customer_wise_item_preservation_price_list_id=$field;

            
            if(isset($_REQUEST["customer_id"]) && !empty($_REQUEST["customer_id"]))
                $field=trim($_REQUEST["customer_id"]);
            else {
                    $field=null;
           }
    $_bll->_mdl->_customer_id=$field;

            
            if(isset($_REQUEST["item_id"]) && !empty($_REQUEST["item_id"]))
                $field=trim($_REQUEST["item_id"]);
            else {
                    $field=null;
           }
    $_bll->_mdl->_item_id=$field;

            
            if(isset($_REQUEST["packing_unit_id"]) && !empty($_REQUEST["packing_unit_id"]))
                $field=trim($_REQUEST["packing_unit_id"]);
            else {
                    $field=null;
           }
    $_bll->_mdl->_packing_unit_id=$field;

            
            if(isset($_REQUEST["rent_kg_per_month"]) && !empty($_REQUEST["rent_kg_per_month"]))
                $field=trim($_REQUEST["rent_kg_per_month"]);
            else {
                    $field=null;
           }
    $_bll->_mdl->_rent_kg_per_month=$field;

            
            if(isset($_REQUEST["season_rent_per_kg"]) && !empty($_REQUEST["season_rent_per_kg"]))
                $field=trim($_REQUEST["season_rent_per_kg"]);
            else {
                    $field=null;
           }
    $_bll->_mdl->_season_rent_per_kg=$field;

            
            if(isset($_REQUEST["created_date"]) && !empty($_REQUEST["created_date"]))
                $field=trim($_REQUEST["created_date"]);
            else {
                    $field=null;
           }
    $_bll->_mdl->_created_date=$field;

            
            if(isset($_REQUEST["created_by"]) && !empty($_REQUEST["created_by"]))
                $field=trim($_REQUEST["created_by"]);
            else {
                    $field=null;
           }
    $_bll->_mdl->_created_by=$field;

            
            if(isset($_REQUEST["modified_date"]) && !empty($_REQUEST["modified_date"]))
                $field=trim($_REQUEST["modified_date"]);
            else {
                    $field=null;
           }
    $_bll->_mdl->_modified_date=$field;

            
            if(isset($_REQUEST["modified_by"]) && !empty($_REQUEST["modified_by"]))
                $field=trim($_REQUEST["modified_by"]);
            else {
                    $field=null;
           }
    $_bll->_mdl->_modified_by=$field;

            
            if(isset($_REQUEST["company_id"]) && !empty($_REQUEST["company_id"]))
                $field=trim($_REQUEST["company_id"]);
            else {
                    $field=null;
           }
    $_bll->_mdl->_company_id=$field;

            if(isset($_REQUEST["transactionmode"]))
                $tmode=$_REQUEST["transactionmode"];
            else
                $tmode="I";
            $_bll->_mdl->_transactionmode =$tmode;
        $_bll->dbTransaction();
}

if(isset($_REQUEST["transactionmode"]) && $_REQUEST["transactionmode"]=="D")       
{   
     $_bll->fillModel();
     $_bll->dbTransaction();
}
