<?php
header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $messages = array();

  if (!empty($_COOKIE['save'])) {
    setcookie('save', '', 100000);
    $messages[] = 'Результаты были сохранены';
  }

  $errors = array();
  $errors['name'] = !empty($_COOKIE['name_error']);
  $errors['email'] = !empty($_COOKIE['email_error']);
  $errors['birthdayear'] = !empty($_COOKIE['birthdayear_error']);
  $errors['gen'] = !empty($_COOKIE['gen_error']);
  $errors['body'] = !empty($_COOKIE['body_error']);
  $errors['ability'] = !empty($_COOKIE['ability_error']);
  $errors['biographiya'] = !empty($_COOKIE['biographiya_error']);
  $errors['check'] = !empty($_COOKIE['check_error']);

  if ($errors['name']) {
    setcookie('name_error', '', 100000);
    $messages[] = '<div class="error">Как вас зовут?</div>';
  }
  if ($errors['email']) {
    setcookie('email_error', '', 100000);
    $messages[] = '<div class="error">Напишить свой e-mail</div>';
  }
  if ($errors['birthdayear']) {
    setcookie('birthdayear_error', '', 100000);
    $messages[] = '<div class="error">В каком году вы родились?</div>';
  }
  if ($errors['gen']) {
    setcookie('gen_error', '', 100000);
    $messages[] = '<div class="error">Какого вы пола?</div>';
  }
  if ($errors['body']) {
    setcookie('body_error', '', 100000);
    $messages[] = '<div class="error">>Сколько у вас конечностей?</div>';
  }
  if ($errors['ability']) {
    setcookie('ability_error', '', 100000);
    $messages[] = '<div class="error">Какие бы вы хотели суперспособности?</div>';
  }
  if ($errors['biographiya']) {
    setcookie('biographiya_error', '', 100000);
    $messages[] = '<div class="error">Напишите про себя</div>';
  }
    if ($errors['check']) {
    setcookie('check_error', '', 100000);
    $messages[] = '<div class="error">Ознакомьтесь с соглашением.</div>';
  }

  $values = array();
  $values['name'] = empty($_COOKIE['name_value']) ? '' : $_COOKIE['name_value'];
  $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
  $values['birthdayear'] = empty($_COOKIE['birthdayear_value']) ? '' : $_COOKIE['birthdayear_value'];
  $values['gen'] = empty($_COOKIE['gen_value']) ? '' : $_COOKIE['gen_value'];
  $values['body'] = empty($_COOKIE['body_value']) ? '' : $_COOKIE['body_value'];
  $values['ability'] = empty($_COOKIE['ability_value']) ? array() : json_decode($_COOKIE['ability_value']);
  $values['biographiya'] = empty($_COOKIE['biographiya_value']) ? '' : $_COOKIE['biographiya_value'];
  $values['check'] = empty($_COOKIE['check_value']) ? '' : $_COOKIE['check_value'];

  include('form.php');
  exit();
}

$errors = FALSE;
if (empty($_POST['name'])) {
  setcookie('name_error', '1', time() + 24 * 60 * 60);
  $errors = TRUE;
}
else {
  setcookie('name_value', $_POST['name'], time() + 30 * 24 * 60 * 60);
}

if (empty($_POST['email']) || !preg_match('/^[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}$/i', $_POST['email'])) {
  setcookie('email_error', '1', time() + 24 * 60 * 60);
  $errors = TRUE;
}
else {
  setcookie('email_value', $_POST['email'], time() + 30 * 24 * 60 * 60);
}

if (empty($_POST['birthdayear']) || !is_numeric($_POST['birthdayear']) || !preg_match('/^\d+$/', $_POST['birthdayear'])) {
  setcookie('birthdayear_error', '1', time() + 24 * 60 * 60);
  $errors = TRUE;
}
else {
  setcookie('birthdayear_value', $_POST['birthdayear'], time() + 30 * 24 * 60 * 60);
}

if (empty($_POST['gen']) || ($_POST['gen']!='m' && $_POST['gen']!='f')) {
  setcookie('gen_error', '1', time() + 24 * 60 * 60);
  $errors = TRUE;
}
else {
  setcookie('gen_value', $_POST['gen'], time() + 30 * 24 * 60 * 60);
}
if (empty($_POST['body']) || ($_POST['body']!='3' && $_POST['body']!='4' && $_POST['body']!='5')) {
   setcookie('body_error', '1', time() + 24 * 60 * 60);
   $errors = TRUE;
}
else {
  setcookie('body_value', $_POST['body'], time() + 30 * 24 * 60 * 60);
}

foreach ($_POST['ability'] as $ability) {
  if (!is_numeric($ability) || !in_array($ability, [1, 2, 3, 4])) {
    setcookie('ability_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
    break;
  }
}
if (!empty($_POST['ability'])) {
  setcookie('ability_value', json_encode($_POST['ability']), time() + 24 * 60 * 60);
}

if (empty($_POST['biographiya']) || !preg_match('/^[0-9A-Za-z0-9А-Яа-я,\.\s]+$/', $_POST['biographiya'])) {
    setcookie('biographiya_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
}
else {
  setcookie('biographiya_value', $_POST['biographiya'], time() + 30 * 24 * 60 * 60);
}
if (!isset($_POST['check'])) {
    setcookie('check_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
}
else {
  setcookie('check_value', $_POST['check'], time() + 30 * 24 * 60 * 60);
}

if ($errors) {
	setcookie('save','',100000);
    header('Location: index.php');
}
    else {
      setcookie('name_error', '', 100000);
      setcookie('email_error', '', 100000);
      setcookie('birthdayear_error', '', 100000);
      setcookie('gen_error', '', 100000);
      setcookie('body_error', '', 100000);
      setcookie('ability_error', '', 100000);
	  setcookie('check_error', '', 100000);
    }

$user = 'u54409';
$pass = '3113126';
$db = new PDO('mysql:host=localhost;dbname=u54409', $user, $pass,
  [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]); // Заменить test на имя БД, совпадает с логином uXXXXX

try {
  $stmt = $db->prepare("INSERT INTO forma SET name = ?, email = ?, birthday = ?, sex = ?, limbs = ?, biographiya = ?");
  $stmt->execute([$_POST['name'], $_POST['email'], $_POST['birthdayear'], $_POST['gen'], $_POST['body'], $_POST['biographiya']]);
  $app_id = $db->lastInsertId();
  $stmt = $db->prepare("INSERT INTO abforma SET app_id = ?, a_id=?");
  foreach ($_POST['ability'] as $ability) {
    $stmt->execute([$app_id,$ability ]);
  }
}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}
    if(!$errors){
      setcookie('save', '1');
    }
header('Location: ./');
