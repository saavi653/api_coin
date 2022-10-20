<?php
include("controller.php");
if (isset($_GET['name'])) 
{
    $name = $_GET['name'];
    $con = new controller();
    $response = $con->hit();
    foreach($response['data'] as $key => $value) 
    {
        if($name == $value['name']) 
        {
            $data = $value;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Description</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class=container>
        <header>
            <img id=img src="img.svg" width=10% ;height=10%>
            <?php
                if(isset($_SESSION['login'])) 
                {?>
                    <div class="btn"><a href="logout.php">logout</a></div>
                <?php } ?>
        </header>
        <div class="back">
            <div id="hd"><?php echo $data['rank'];
            echo "<br>" . "Rank" ?></div>
            <div id="hd2"><?php echo $data['id'] . " ( " . $data['symbol'] . " ) ";
            echo "<br>" . round($data['supply']) ?></div>
            <div class="heading2"><?php echo "Market Cap";
            echo "<br>" . round($data['marketCapUsd']) ?></div>
            <div class="heading2"><?php echo "Volume (24Hr)";
            echo "<br>" . round($data['volumeUsd24Hr']) ?> </div>
            <div class="heading2"><?php echo "Supply";
            echo "<br>" . round($data['supply']) ?></div>
            <div class="dis">
                <div class="top">
                    <?php
                        $name = strtolower($data['symbol']);
                        echo "<td>" . "<img src=https://assets.coincap.io/assets/icons/$name@2x.png width=50px height=50px>" . "</td>";
                        echo $data['id'] . " ( " . $data['symbol'] . " )";
                        echo "<br>" . date("Y-m-d"); 
                    ?>
                </div>
                <div class="top">HIGH $19,685.33<br> LOW $19,133.53</div>
                <div class="top"> AVERAGE $19,407.23 <br> CHANGE -2.15%</div>
            </div>
        </div>
        <form action="" method="post">
            <div class="graph"><img src="graph.png" width="800px" height="500px"></div>
            <div id="sell">
                <div class="btn1"><input type="text" name="b_coin">
                <input type="submit" name="buy" value="BUY"></div>
                <div class="btn1"><input type="text" name="s_coin">
                <input type="submit" name="sell" value="SELL"></div>
                <div class="btn1"><input type="text" name="add_money">
                <input type="submit" name="money" value="ADD MONEY"></div>
                <?php
                $obj = new validation();
                    $error = 0;
                    if (isset($_POST['buy'])) 
                    {
                        $error = $obj->validate_coin($_POST['b_coin']);
                    }
                    if (isset($_POST['sell'])) 
                    {
                        $error = $obj->validate_coin($_POST['s_coin']);
                    }
                    if(isset($_POST['money']))
                    {
                        $error = $obj->validate_coin($_POST['add_money']);
                    }
                    if ($error == 0) 
                    {
                        if (!isset($_SESSION['login'])) 
                        {
                            echo "<a href=\"login.php\">ERROR:PLEASE LOGIN</a><br><a href=\"signup.php\">Don't have an account?SIGNUP</a>";
                        }
                        else 
                        {
                            if (isset($_POST['buy']) || isset($_POST['sell']) || isset($_POST['money'])) 
                            {
                                $_SESSION['name'] = $_GET['name'];
                                $_SESSION['buy'] = $_POST['b_coin'];
                                $_SESSION['sell'] = $_POST['s_coin'];
                                $_SESSION['money']=$_POST['add_money'];
                                header("location:coin.php");
                            }
                        }
                    }
                ?>
            </div>    
        </form>
        <footer class="ft">
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
<?php
    } 
?>