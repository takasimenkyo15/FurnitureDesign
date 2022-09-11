<?php
  session_start();
  $mode = 'input';
  if( isset($_POST['back']) && $_POST['back'] ){
    // 何もしない
  } else if( isset($_POST['confirm']) && $_POST['confirm'] ){
    $_SESSION['fullname'] = $_POST['fullname'];
    $_SESSION['email']    = $_POST['email'];
    $_SESSION['message']  = $_POST['message'];
    $mode = 'confirm';
  } else if( isset($_POST['send']) && $_POST['send'] ){
    // 送信ボタンを押したとき
    $message  = "お問い合わせを受け付けました \r\n"
              . "名前: " . $_SESSION['fullname'] . "\r\n"
              . "email: " . $_SESSION['email'] . "\r\n"
              . "お問い合わせ内容:\r\n"
              . preg_replace("/\r\n|\r|\n/", "\r\n", $_SESSION['message']);
	  mail($_SESSION['email'],'お問い合わせありがとうございます',$message);
    mail('takashimenkyo15@yahoo.co.jp','お問い合わせありがとうございます',$message);
    $_SESSION = array();
    $mode = 'send';
  } else {
    $_SESSION['fullname'] = "";
    $_SESSION['email']    = "";
    $_SESSION['message']  = "";
  }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>お問合せフォーム</title>
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <!-- <link href="https://takasimenkyo15.github.io/FurnitureDesign/style.css" media="all" rel="stylesheet"> -->
  <link href="contactform.css" media="all" rel="stylesheet">
  <link rel="stylesheet" href="https://takasimenkyo15.github.io/FurnitureDesign/responsive.css">
</head>
<header>
    <a href=""><h1>Furniture  Design</h1></a>
    <div class="openbtn"><span></span><span></span>
      <!-- <span></span> -->
    </div>
    <nav id="g-nav">
      <ul>
       <li><a href="https://takasimenkyo15.github.io/FurnitureDesign/products.html">PRODUCTS</a></li>
       <li><a href="https://takasimenkyo15.github.io/FurnitureDesign/about.html">ABOUT</a></li>
       <li><a href="https://takasimenkyo15.github.io/FurnitureDesign/company.html">COMPANY</a></li>         
       <li><a href="https://takasimenkyo15.github.io/FurnitureDesign/mailto:info@example.com">CONTACT</a></li>
      </ul>
    </nav>
  </header>
<body>
  <?php if( $mode == 'input' ){ ?>
    <!-- 入力画面 -->
    <form action="./contactform.php" method="post">
      名前    <input type="text"    name="fullname" value="<?php echo $_SESSION['fullname'] ?>"><br>
      Eメール <input type="email"   name="email"    value="<?php echo $_SESSION['email'] ?>"><br>
      お問い合わせ内容<br>
      <textarea cols="40" rows="8" name="message"><?php echo $_SESSION['message'] ?></textarea><br>
      <input type="submit" name="confirm" value="確認" />
    </form>
  <?php } else if( $mode == 'confirm' ){ ?>
    <!-- 確認画面 -->
    <form action="./contactform.php" method="post">
      名前    <?php echo $_SESSION['fullname'] ?><br>
      Eメール <?php echo $_SESSION['email'] ?><br>
      お問い合わせ内容<br>
      <?php echo nl2br($_SESSION['message']) ?><br>
      <input type="submit" name="back" value="戻る" />
      <input type="submit" name="send" value="送信" />
    </form>
  <?php } else { ?>
    <!-- 完了画面 -->
    送信しました。お問い合わせありがとうございました。<br>
  <?php } ?>

  <script src="https://takasimenkyo15.github.io/FurnitureDesign/script.js"></script>
</body>
</html>


