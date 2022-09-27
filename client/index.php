<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Client-SOAP WS</title>
</head>

<body>
    <form action="" method="post">
    <input type="submit" value="VN" name="vn">
    <input type="submit" value="en" name="en">
    </form> 
    <?php
    if (isset($_POST['vn'])) {
        $client = new SoapClient("http://localhost:1000/server/Hello.wsdl", array('trace' => 1));
        $return1 = $client->__soapCall("currency_format", array("23000"));
        echo $return1;
    } else {
        $client = new SoapClient("http://localhost:1000/server/Hello.wsdl", array('trace' => 1));
        $return1 = $client->__soapCall("currency_usd", array("23000"));
        echo $return1;
    }
    ?>


</body>

</html>