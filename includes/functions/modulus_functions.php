<?php


    /* ==================================================================================
    ========= Register functions =======================================================
    ===================================================================================*/
    
    function checkEmailExist( $email ){
        global $con;
        $stmt = $con->prepare("SELECT Email FROM users WHERE Email = ? ");
        $stmt->execute( array( $email ) );
        $count =  $stmt->rowCount();
        return $count; 
    }

    function checkUsernameExist( $username ){
        global $con;
        $stmt = $con->prepare("SELECT Username FROM users WHERE Username = ? ");
        $stmt->execute( array( $username ) );
        $count =  $stmt->rowCount();
        return $count; 
    }


 
    function tokenValue( $email ){
        global $con;
        $stmt = $con->prepare("SELECT token FROM users WHERE Email = ? LIMIT 1");
        $stmt->execute( array( $email ) );
        $row = $stmt->fetch();
        return $row["token"];
    }

    function getUserId( $email ){ 
        global $con;
        $stmt = $con->prepare("SELECT UserID FROM users WHERE Email = ? LIMIT 1");
        $stmt->execute( array( $email ) );
        $row = $stmt->fetch();
        return $row["UserID"];
    }

    function getDbPassword( $email ){ 
        global $con;
        $stmt = $con->prepare("SELECT Pass FROM users WHERE Email = ? LIMIT 1");
        $stmt->execute( array( $email ) );
        $row = $stmt->fetch();
        return $row["Pass"];
    }


    function userType( $loginUserID ){ 
        global $con;
        $stmt = $con->prepare("SELECT GroupID FROM users WHERE UserID = ? LIMIT 1");
        $stmt->execute( array( $loginUserID ) );
        $row = $stmt->fetch();
        return $row["GroupID"];
    }


    function getAllTable( $table ){ 
        global $con;
        $stmt = $con->prepare("SELECT * FROM $table ");
        $stmt->execute( );
        $row = $stmt->fetchAll();
        return $row;
    }

    function countRecords( $id , $table ){ 

        global $con;
        $stmt = $con->prepare("SELECT COUNT( $id ) FROM $table ");
        $stmt->execute( );   // do the statment
        return $stmt->fetchColumn(); 

    }

    function getRecordInfo( $table , $where , $value){
        global $con;
        $stmt = $con->prepare("SELECT * FROM $table WHERE $where = ? LIMIT 1 ");
        $stmt->execute( array( $value ) );
        $row = $stmt->fetch();
        return $row;
    }

    function checkRecord($select, $from, $value){
        global $con;
        $statment = $con->prepare("SELECT $select FROM $from WHERE $select = ?");
        $statment ->execute(array($value));
        $count =  $statment->rowCount();
        return $count;
    }
   
    function getUserInfoByEmail( $email ){
        global $con;
        $stmt = $con->prepare("SELECT * FROM `users` WHERE `Email` = ? LIMIT 1 ");
        $stmt->execute( array( $email ) );
        $row = $stmt->fetch();
        return $row;
    }

    /* ==================================================================================
    ========= index functions =======================================================
    ===================================================================================*/


    function getLastedProducts(){ 
        global $con;
        $stmt = $con->prepare("SELECT * FROM `products` WHERE `status` = 1 ORDER BY id DESC LIMIT 8  ");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }
 

    function Alltestmonials(){ // for home page 
        global $con;
        $stmt = $con->prepare("SELECT * FROM comments WHERE seller_ID IS NULL ORDER BY comment_ID DESC LIMIT 5");
        $stmt->execute();
        $row = $stmt->fetchAll();
        return $row;
    }
    
    function getSuccessExchanges(){ 
        global $con;
        $stmt = $con->prepare("SELECT * FROM `exchanges` WHERE `accepted` = 1  AND `product_id` IS NULL  ORDER BY id DESC ");
        $stmt->execute( );
        $rows = $stmt->fetchAll();
        return $rows;
    }

    /* ==================================================================================
    ========= Mytransfers functions =====================================================
    ===================================================================================*/

    
    function countMyTransfersByEmail( $email ){ 
        global $con;
        $stmt = $con->prepare("SELECT COUNT( `id` ) FROM `exchanges` WHERE email_1 = ? OR email_2 = ? LIMIT 10 ");
        $stmt->execute( array( $email , $email) );   
        return $stmt->fetchColumn(); 
    }
    
    function countPenddingTransfers( $email ){ 
        global $con;
        $stmt = $con->prepare(" SELECT COUNT( `id` ) FROM `exchanges` WHERE `status` = '0' AND ( `email_1` = ? OR `email_2` = ? ) ");
        $stmt->execute( array( $email , $email) );   
        return $stmt->fetchColumn(); 
    }
    
    function countSuccessTransfers( $email ){ 
        global $con;
        $stmt = $con->prepare(" SELECT COUNT( `id` ) FROM `exchanges` WHERE `status` = '1' AND ( `email_1` = ? OR `email_2` = ? ) ");
        $stmt->execute( array( $email , $email) );   
        return $stmt->fetchColumn(); 
    }
    
    function countFailedTransfers( $email ){ 
        global $con;
        $stmt = $con->prepare(" SELECT COUNT( `id` ) FROM `exchanges` WHERE `status` = '2' AND ( `email_1` = ? OR `email_2` = ? ) ");
        $stmt->execute( array( $email , $email) );   
        return $stmt->fetchColumn(); 
    }


    function getMyTransfersByEmail( $email ){ // for home page 
        global $con;
        $stmt = $con->prepare("SELECT * FROM `exchanges` WHERE email_1 = ? OR email_2 = ? ");
        $stmt->execute( array( $email , $email ) );    
        $rows = $stmt->fetchAll();
        return $rows;
    }
    

    /* ==================================================================================
    ========= Inbox functions ===========================================================
    ===================================================================================*/
    
    function InboxUserExist( $UserID ){
        global $con;
        $stmt = $con->prepare("SELECT UserID FROM users WHERE UserID = ? AND GroupID != 3 ");
        $stmt->execute( array( $UserID ) );
        $count =  $stmt->rowCount();
        return $count; 
    }

    function getLastMsg ( $chat_Link ){ 
        global $con;
        $stmt = $con->prepare("SELECT message FROM messages WHERE chat_Link = ? ORDER BY `msg_id` DESC LIMIT 1 ");
        $stmt->execute( array( $chat_Link ) );
        $row = $stmt->fetch();
        return $row["message"];
    }

    function getLastMsgSender ( $chat_Link ){ 
        global $con;
        $stmt = $con->prepare("SELECT Sender_ID FROM messages WHERE chat_Link = ? ORDER BY `msg_id` DESC LIMIT 1 ");
        $stmt->execute( array( $chat_Link ) );
        $row = $stmt->fetch();
        return $row["Sender_ID"];
    }

    function getLastMsgType ( $chat_Link ){ 
        global $con;
        $stmt = $con->prepare("SELECT msg_type FROM messages WHERE chat_Link = ? ORDER BY `msg_id` DESC LIMIT 1 ");
        $stmt->execute( array( $chat_Link ) );
        $row = $stmt->fetch();
        return $row["msg_type"];
    }

    /* ==================================================================================
    ========= search pages ==========================================================
    ===================================================================================*/

    function getFirstpayment( ){
        global $con;
        $stmt = $con->prepare("SELECT * FROM `payment_methods` ORDER BY id ASC LIMIT 1 ");
        $stmt->execute( );
        $row = $stmt->fetch();
        return $row;
    }

        

    /* ==================================================================================
    ========= View functions =====================================================
    ===================================================================================*/


    function countProductSales( $productId ){ 
        global $con;
        $stmt = $con->prepare("SELECT COUNT( `id` ) FROM `exchanges` WHERE product_id = ? AND `status` = 1  ");
        $stmt->execute( array( $productId ) );   
        return $stmt->fetchColumn(); 
    }


    /* ==================================================================================
    ========= Categories pages ==========================================================
    ===================================================================================*/
    function checkPaymentExist( $id ){
        global $con;
        $stmt = $con->prepare("SELECT id FROM payment_methods WHERE id = ? ");
        $stmt->execute( array( $id ) );
        $count = $stmt->rowCount();
        return $count; 
    }

    function countCustomProducts( $category ){ 
        global $con;
        $stmt = $con->prepare("SELECT COUNT( `id` ) FROM `products` WHERE category = ? AND `status` = 1 ");
        $stmt->execute( array( $category ) );   // do the statment
        return $stmt->fetchColumn(); 
    }

    function getAllProductsByName( $category ){ 
        global $con;
        $stmt = $con->prepare("SELECT * FROM `products` WHERE category = ? AND `status` = 1 ORDER BY id DESC ");
        $stmt->execute( array( $category ) );
        $rows = $stmt->fetchAll();
        return $rows;
    }

    /* ==================================================================================
    ========= Exchanges pages ==========================================================
    ===================================================================================*/
    function getPaymentInfoByName( $name ){
        global $con;
        $stmt = $con->prepare("SELECT * FROM `payment_methods` WHERE `name` = ? LIMIT 1 ");
        $stmt->execute( array( $name ) );
        $row = $stmt->fetch();
        return $row;
    }

    
    /* ==================================================================================
    ========= notifications ==========================================================
    ===================================================================================*/
    function getAllNotifications( $userid ){ 
        global $con;
        $stmt = $con->prepare("SELECT * FROM notifications WHERE receiver = ? AND accepted = 0 ORDER BY id DESC LIMIT 4 ");
        $stmt->execute( array( $userid ) );
        $row = $stmt->fetchAll();
        return $row;
    }

    function countNotifications( $userid ){ 
        global $con;
        $stmt = $con->prepare("SELECT COUNT( `id` ) FROM notifications WHERE receiver = ? AND accepted = 0 ");
        $stmt->execute( array( $userid ) );   // do the statment
        return $stmt->fetchColumn(); 
    }
    
    /* ==================================================================================
    ========= payment_request ==========================================================
    ===================================================================================*/
    function checkTransferExist( $transferid ){
        global $con;
        $stmt = $con->prepare("SELECT transfer_id FROM exchanges WHERE transfer_id = ? AND accepted = 0 ");
        $stmt->execute( array( $transferid ) );
        $count = $stmt->rowCount();
        return $count; 
    }

    function getTransferInfo( $transferid ){
        global $con;
        $stmt = $con->prepare("SELECT * FROM `exchanges` WHERE `transfer_id` = ? LIMIT 1 ");
        $stmt->execute( array( $transferid ) );
        $row = $stmt->fetch();
        return $row;
    }

    /* ==================================================================================
    ========= Profile ==========================================================
    ===================================================================================*/
    function getSellerProducts( $UserID ){  
        global $con;
        $stmt = $con->prepare("SELECT * FROM `products` WHERE UserID = ? ORDER BY id DESC LIMIT 8  ");
        $stmt->execute( array( $UserID ) );
        $rows = $stmt->fetchAll();
        return $rows;
    }

    function countSellerStars( $userid ){ 
        global $con;
        $stmt = $con->prepare("SELECT COUNT( `rating` ) FROM `comments` WHERE seller_ID = ? ");
        $stmt->execute( array( $userid ) );   
        return $stmt->fetchColumn(); 
    }

    function getSellerStars( $userid ){ 
        global $con;
        $stmt = $con->prepare("SELECT rating FROM `comments` WHERE seller_ID = ?  ");
        $stmt->execute( array( $userid ) );
        $rows = $stmt->fetchAll();
        return $rows;
    }


    function getCommentStars( $userid ){ 
        global $con;
        $stmt = $con->prepare("SELECT rating FROM `comments` WHERE `user_ID` = ? LIMIT 1 ");
        $stmt->execute( array( $userid ) );
        $row = $stmt->fetch();
        return $row;
    }


    function getTransfers( $email ){ 
        global $con;
        $stmt = $con->prepare("SELECT * FROM `exchanges` WHERE email_2 = ? AND `status` = 1 ");
        $stmt->execute( array( $email ) );
        $rows = $stmt->fetchAll();
        return $rows;
    }


    function countSellerjobs( $email ){ 
        global $con;
        $stmt = $con->prepare("SELECT COUNT( `id` ) FROM `exchanges` WHERE email_2 = ? AND `status` = 1 ");
        $stmt->execute( array( $email ) );   
        return $stmt->fetchColumn(); 
    }

    function sellerComments( $UserID ){
        global $con;
        $stmt = $con->prepare("SELECT * FROM comments WHERE seller_ID = ? ");
        $stmt->execute( array( $UserID ) );
        $rows = $stmt->fetchAll();
        return $rows; 
    }



    /* ==================================================================================
    ========= Admin Payments functions =================================================
    ===================================================================================*/
    
    function getAllPayments( ){  
        global $con;
        $stmt = $con->prepare("SELECT * FROM `payment_methods` ORDER BY id DESC ");
        $stmt->execute( );
        $rows = $stmt->fetchAll();
        return $rows;
    }

    function getPaymentInfo( $id ){
        global $con;
        $stmt = $con->prepare("SELECT * FROM `payment_methods` WHERE `id` = ? LIMIT 1 ");
        $stmt->execute( array( $id ) );
        $row = $stmt->fetch();
        return $row;
    }


    /* ==================================================================================
    ========= Admin users/ sellers functions ============================================
    ===================================================================================*/
    function getAllUsers( $GroupID , $from , $to ){ 
        global $con;
        $stmt = $con->prepare("SELECT * FROM users WHERE GroupID = ? ORDER BY UserID DESC LIMIT $from , $to ");
        $stmt->execute( array( $GroupID ) );
        $row = $stmt->fetchAll();
        return $row;
    }
    
    function countUsers( $GroupID ){ 

        global $con;
        $stmt = $con->prepare("SELECT COUNT( `UserID` ) FROM users WHERE GroupID = ? ");
        $stmt->execute( array( $GroupID ) );   // do the statment
        return $stmt->fetchColumn(); 

    }

    function getUserInfo( $UserID ){
        global $con;
        $stmt = $con->prepare("SELECT * FROM `users` WHERE `UserID` = ? LIMIT 1 ");
        $stmt->execute( array( $UserID ) );
        $row = $stmt->fetch();
        return $row;
    }

    function checkUserIdExist( $UserID ){
        global $con;
        $stmt = $con->prepare("SELECT UserID FROM users WHERE UserID = ? AND GroupID = 1 ");
        $stmt->execute( array( $UserID ) );
        $count =  $stmt->rowCount();
        return $count; 
    }

    function checkSellerIdExist( $UserID ){
        global $con;
        $stmt = $con->prepare("SELECT UserID FROM users WHERE UserID = ? AND GroupID = 2 ");
        $stmt->execute( array( $UserID ) );
        $count =  $stmt->rowCount();
        return $count; 
    }

    /* ==================================================================================
    ========= Admin Comments functions ====================================================
    ===================================================================================*/
    function getAllComments(  $from , $to ){ 
        global $con;
        $stmt = $con->prepare("SELECT comments.*,  users.Email  FROM comments
                                    INNER JOIN users ON users.UserID = comments.User_ID WHERE seller_ID IS NULL
                                    ORDER BY comment_ID DESC LIMIT $from , $to ");
        $stmt->execute( array(  ) );
        $row = $stmt->fetchAll();
        return $row;
    }


    function countComments(){ 
        global $con;
        $stmt = $con->prepare("SELECT COUNT( `comment_ID` ) FROM comments WHERE seller_ID IS NULL ");
        $stmt->execute( );   
        return $stmt->fetchColumn(); 
    }
    /* ==================================================================================
    ========= Admin Exchanges functions =================================================
    ===================================================================================*/
    
    function getAllExchanges(){ 
        global $con;
        $stmt = $con->prepare("SELECT * FROM `exchanges` WHERE `accepted` = 1  ORDER BY id DESC ");
        $stmt->execute( );
        $rows = $stmt->fetchAll();
        return $rows;
    }
    
    function countExchanges(){ 
        global $con;
        $stmt = $con->prepare("SELECT COUNT( `id` ) FROM `exchanges` WHERE `accepted` = 1  ");
        $stmt->execute( array() );   
        return $stmt->fetchColumn(); 
    }

    function getExchangeInfo( $transfer_id ){
        global $con;
        $stmt = $con->prepare("SELECT * FROM `exchanges` WHERE `transfer_id` = ? AND `accepted` = 1 LIMIT 1 ");
        $stmt->execute( array( $transfer_id ) );
        $row = $stmt->fetch();
        return $row;
    }

    function checkExchangeExist( $transfer_id ){
        global $con;
        $stmt = $con->prepare("SELECT transfer_id FROM exchanges WHERE transfer_id = ? AND `accepted` = 1 ");
        $stmt->execute( array( $transfer_id ) );
        $count =  $stmt->rowCount();
        return $count; 
    }

    
    /* ==================================================================================
    ========= Admin products functions ============================================
    ===================================================================================*/
    function getAllProducts(){ 
        global $con;
        $stmt = $con->prepare("SELECT * FROM `products` ORDER BY id DESC ");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }

    function checkProductExist( $id ){
        global $con;
        $stmt = $con->prepare("SELECT id FROM products WHERE id = ?  ");
        $stmt->execute( array( $id ) );
        $count =  $stmt->rowCount();
        return $count; 
    }

    function countProducts(){ 
        global $con;
        $stmt = $con->prepare("SELECT COUNT( `id` ) FROM `products` ");
        $stmt->execute( array(  ) );   // do the statment
        return $stmt->fetchColumn(); 
    }

    function getProductInfo( $id ){
        global $con;
        $stmt = $con->prepare("SELECT * FROM `products` WHERE `id` = ? LIMIT 1 ");
        $stmt->execute( array( $id ) );
        $row = $stmt->fetch();
        return $row;
    }

?>
