<?php
header("Content-type: text/xml");
 
function xml_entities($string) {
    return str_replace(
            array("&", "<", ">", '"', "'"), array("&amp;", "&lt;", "&gt;", "&quot;", "&apos;"), $string
    );
}
$conn = mysqli_connect("localhost", "root", "", "steam") or die("Khong the ket noi CSDL");
mysqli_set_charset($conn,"utf8");
$query = "SELECT * FROM goccuagau";
$result = mysqli_query($conn, $query);
 
$items = '';
while ($row = mysqli_fetch_array($result)) {
    $items .= '<item>';
        $items .= "<title>" . xml_entities($row['Title']) . "</title>";
        $items .= "<image>" . xml_entities($row['Image']) . "</image>";
         $items .= "<date>" . xml_entities($row['Date']) . "</date>";
        $items .= "<description>" . xml_entities($row['Description']) . "</description>";
    $items .= '</item>';
}
 
echo '<?xml version="1.0"?>
<rss version="2.0">
    <channel>
        <title> ' . xml_entities('Gốc của Gấu') . ' </title>
        <link>' . xml_entities('https://SPBshop.com') . '</link>
        <description> ' . xml_entities('Sho Gấu SPBshop') . ' </description>
        <language>vi_VN</language>
        '.$items.'
    </channel>
</rss>';
?>