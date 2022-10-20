<?php
include("controller.php");
$con = new controller();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class=container>
        <header>
            <img id=img src="img.svg" width=10% ;height=10%>
            <div class="wel">
                <?php if (isset($_SESSION['login'])) 
                {
                    echo "<u> WELCOME USER </u>";
                }?>
            </div>
            <div id="search">
                <form action="" method="post">
                    <input type="text" name="search">
                    <input type="submit" name='submit' value="SEARCH" />
                </form>    
                    <?php
                        if (isset($_POST['submit'])) 
                        {
                            $con->search($_POST['search']);
                        }
                    ?>
            </div>
            <div class="btn"><a href="index.php">Refresh</a></div>
        </header>
        <div class="back">
            <div class="heading">MARKET CAP<br>$1.13T</div>
            <div class="heading">EXCHANGE VOL<br>$482.61B</div>
            <div class="heading">ASSETS<br>2,295</div>
            <div class="heading">EXCHANGES<br>73</div>
            <div class="heading">MARKETS<br>13,857</div>
            <div class="heading">BTC DOM INDEX<br>33.4%</div>
            <div class="main">
                <?php
                    $response = $con->hit();
                ?>
                <table class="data">
                    <tr class="tr">
                        <th>Rank</th>
                        <th></th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Market cap</th>
                        <th>VWAP(24Hr) </th>
                        <th>Supply</th>
                        <th>Volume</th>
                        <th>Change</th>
                    </tr><?php
                        foreach ($response['data'] as $key => $v) 
                        {
                            ?><tr class="tr"><?php
                            echo "<td>" . $v['rank'] . "</td>";
                            $name = strtolower($v['symbol']);
                            echo "<td>" . "<img src=https://assets.coincap.io/assets/icons/$name@2x.png width=30px height=30px>" . "</td>";
                            echo "<td class=\"icon\">" . "<a href='des.php?name=" . $v['name'] . "'>" . $v['name'] . "</a>" . "<br>";
                            echo $v['symbol'] . "</td>";
                            echo "<td>" . "$" . number_format($v['priceUsd'], 2) . "</td>";
                            echo "<td>" . "$" . round($v['marketCapUsd']) . "</td>";
                            echo "<td>" . "$" .  round($v['vwap24Hr']) . "</td>";
                            echo "<td>" . round($v['supply']) . "</td>";
                            echo "<td>" . "$" .  round($v['volumeUsd24Hr']) . "</td>";
                            echo "<td style='color:red;'>" . number_format($v['changePercent24Hr'], 2) . "%" .  "</td>";
                            ?></tr><?php
                        }?>
                </table>
            </div>
        </div>
        <footer class="ft" style="margin-top:6050px;">
            <table>
                <tr>
                    <th>COINCAP.IO</th>
                    <th>LEGALS</th>
                    <th>FOLLOW US</th>
                    <th>COINCAP APP AVAILABLE ON</th>
                </tr>
                <tr>
                    <td>Methodology</td>
                    <td>Terms of Service</td>
                    <td><img id="fb" src="facebook.png">
                    <img id="twitter" src="twitter1.jpg"></td>
                    <td><a href="https://play.google.com/store/apps/details?id=io.coinCap.coinCap"><img src="img1.png"></a></td>
                </tr>
                <tr>
                    <td>Support</td>
                    <td>Privacy Policy</td>
                    <td></td>
                    <td><a href="https://apps.apple.com/us/app/coincap/id1074052280?ign-mpt=uo%3D4"><img src="img2.png"></a></td>
                </tr>
                <tr>
                    <td>Our API</td>
                </tr>
                <tr>
                    <td>Rate Comparison</td>
                    <th>DISCLAIMER</th>
                </tr>
                <tr>
                    <td> Careers</td>
                    <td>Neither ShapeShift AG nor CoinCap are in any way associated with CoinMarketCap, LLC or any of its goods and services.</td>
                </tr>
            </table>
        </footer>
    </div>
</body>
</html>