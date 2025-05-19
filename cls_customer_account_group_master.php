<?php  
include_once(__DIR__ . "/../config/connection.php");
class mdl_customeraccountgroupmaster 
{                        
public $_customer_account_group_id;          
    public $_customer_account_group_name;          
    public $_under_group;          
    public $_created_date;          
    public $_created_by;          
    public $_modified_date;          
    public $_modified_by;          
    public $_company_id;          
    public $_transactionmode;
    
}

class bll_customeraccountgroupmaster                           
{   
    public $_mdl;
    public $_dal;

    public function __construct()    
    {
        $this->_mdl =new mdl_customeraccountgroupmaster(); 
        $this->_dal =new dal_customeraccountgroupmaster();
    }

    public function dbTransaction()
    {
        $this->_dal->dbTransaction($this->_mdl);
               
       
            
       if($this->_mdl->_transactionmode =="D")
       {
            header("Location:../srh_customer_account_group_master.php");
       }
       if($this->_mdl->_transactionmode =="U")
       {
            header("Location:../srh_customer_account_group_master.php");
       }
       if($this->_mdl->_transactionmode =="I")
       {
            header("Location:../frm_customer_account_group_master.php");
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

        $sql="CAll csms1_search('t.customer_account_group_name, t.under_group, t.customer_account_group_id','tbl_customer_account_group_master t')";
        echo "
        <table  id=\"searchMaster\" class=\"ui celled table display\">
        <thead>
            <tr>
            <th>Action</th> 
            <th> Account Group <br><input type=\"text\" data-index=\"1\" placeholder=\"Search Account Group\" /></th> 
                         <th> Under Group <br><input type=\"text\" data-index=\"2\" placeholder=\"Search Under Group\" /></th> 
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
            <form  method=\"post\" action=\"frm_customer_account_group_master.php\" style=\"display:inline; margin-rigth:5px;\">
            <i class=\"fa fa-edit update\" style=\"cursor: pointer;\"></i>
            <input type=\"hidden\" name=\"customer_account_group_id\" value=\"".$_rs["customer_account_group_id"]."\" />
            <input type=\"hidden\" name=\"transactionmode\" value=\"U\"  />
            </form> <form  method=\"post\" action=\"classes/cls_customer_account_group_master.php\" style=\"display:inline;\">
            <i class=\"fa fa-trash delete\" style=\"cursor: pointer;\"></i>
            <input type=\"hidden\" name=\"customer_account_group_id\" value=\"".$_rs["customer_account_group_id"]."\" />
            <input type=\"hidden\" name=\"transactionmode\" value=\"D\"  />
            </form>
            </td>";
        $fieldvalue=$_rs["customer_account_group_name"];
                            $_grid.= "
                            <td> ".$fieldvalue." </td>"; 
                       $fieldvalue=$_rs["under_group"];
                            $_grid.= "
                            <td> ".$fieldvalue." </td>"; 
                       $_grid.= "</tr>\n";
           
            
        }   
         if($j==0) {
                $_grid.= "<tr>";
                $_grid.="<td colspan=\"7\">No records available.</td>";
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
 class dal_customeraccountgroupmaster                         
{
    public function dbTransaction($_mdl)                     
    {
        global $_dbh;

        
        $_dbh->exec("set @p0 = ".$_mdl->_customer_account_group_id);
        $_pre=$_dbh->prepare("CALL customer_account_group_master_transaction (@p0,?,?,?,?,?,?,?,?) ");
        $_pre->bindParam(1,$_mdl->_customer_account_group_name);
        $_pre->bindParam(2,$_mdl->_under_group);
        $_pre->bindParam(3,$_mdl->_created_date);
        $_pre->bindParam(4,$_mdl->_created_by);
        $_pre->bindParam(5,$_mdl->_modified_date);
        $_pre->bindParam(6,$_mdl->_modified_by);
        $_pre->bindParam(7,$_mdl->_company_id);
        $_pre->bindParam(8,$_mdl->_transactionmode);
        $_pre->execute();
        
    }
    public function fillModel($_mdl)
    {
        global $_dbh;
        $_pre=$_dbh->prepare("CALL customer_account_group_master_fillmodel (?) ");
        $_pre->bindParam(1,$_REQUEST["customer_account_group_id"]);
        $_pre->execute();
        $_rs=$_pre->fetchAll(); 
        if(!empty($_rs)) {

        $_mdl->_customer_account_group_id=$_rs[0]["customer_account_group_id"];
        $_mdl->_customer_account_group_name=$_rs[0]["customer_account_group_name"];
        $_mdl->_under_group=$_rs[0]["under_group"];
        $_mdl->_created_date=$_rs[0]["created_date"];
        $_mdl->_created_by=$_rs[0]["created_by"];
        $_mdl->_modified_date=$_rs[0]["modified_date"];
        $_mdl->_modified_by=$_rs[0]["modified_by"];
        $_mdl->_company_id=$_rs[0]["company_id"];
        $_mdl->_transactionmode =$_REQUEST["transactionmode"];
        }
    }
}
$_bll=new bll_customeraccountgroupmaster();

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
 
            
            if(isset($_REQUEST["customer_account_group_id"]) && !empty($_REQUEST["customer_account_group_id"]))
                $field=trim($_REQUEST["customer_account_group_id"]);
            else {
                    $field=0;
           }
    $_bll->_mdl->_customer_account_group_id=$field;

            
            if(isset($_REQUEST["customer_account_group_name"]) && !empty($_REQUEST["customer_account_group_name"]))
                $field=trim($_REQUEST["customer_account_group_name"]);
            else {
                    $field=null;
           }
    $_bll->_mdl->_customer_account_group_name=$field;

            if (isset($_FILES["under_group"]) && $_FILES["under_group"]["error"] === UPLOAD_ERR_OK) {
                $tmp_name = $_FILES["under_group"]["tmp_name"];
                $fileName = basename($_FILES["under_group"]["name"]);
                $fileNameParts = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameParts));
                $safeFileName = preg_replace("/[^a-zA-Z0-9_-]/", "_", pathinfo($fileName, PATHINFO_FILENAME));
                $newFileName = $safeFileName.".".$fileExtension;
                $uploadDir = UPLOAD_DIR . "/customer_account_group_master/";
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                $destPath = $uploadDir . $newFileName;
                // Check if file already exists
                if (!file_exists($destPath)) {
                    move_uploaded_file($fileTmpPath, $destPath);
                }
                $field=$destPath;
            } else {
                $field=null;
            }
        
    $_bll->_mdl->_under_group=$field;

            
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
