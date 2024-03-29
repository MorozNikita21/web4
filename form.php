<!DOCTYPE html>
<html lang="en">
<head>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <title>Task 4</title>
    <link rel="stylesheet" href="style.css">
    <style>
	.error {
    background-color: red;
}
</style>
</head>
<body>
<?php
if (!empty($messages)) {
  print('<div id="messages">');
  foreach ($messages as $message) {
    print($message);
  }
  print('</div>');
}
?>
<div id = "form">
  <form action=""
    method="POST">
    <label>
      Имя:<br />
      <input name="name"
      <?php print($errors['name'] ? 'class="error"' : '');?> value="<?php print $values['name'];?>"/>
    </label><br />
    <label >
      E-mail:<br />
      <input name="email"
        type="email"
        <?php print($errors['email'] ? 'class="error"' : '');?> value="<?php print $values['email'];?>"/>
    </label><br />
    <label>
      Год рождения:<br />
      <select name="birthdayear">
        <?php 
        for ($i = 1950; $i <= 2023; $i++) {
          $selected= ($i == $values['birthdayear']) ? 'selected="selected"' : '';
          printf('<option value="%d" %s>%d год</option>', $i, $selected, $i);
        }
        ?>
      </select><br />
      Пол<br/>
    <label><input type="radio" checked="checked"
      name="gen" value="m" 
      <?php print($errors['gen'] ? 'class="error"' : '');?>
      <?php if ($values['gen']=='m') print 'checked';?>
      />
      Мужской</label>
    <label><input type="radio"
      name="gen" value="f"
    <?php print($errors['gen'] ? 'class="error"' : '');?>
      <?php if ($values['gen']=='f') print 'checked';?>
    />
      Женский</label><br />
      Количество конечностей<br/>
    <div class="lim">
    <label><input type="radio" checked="checked"
      name="body" value="3" 
    <?php print($errors['body'] ? 'class="error"' : '');?>
      <?php if ($values['body']=='3') print 'checked';?>
    />
        3</label>
    <label><input type="radio"
      name="body" value="4" 
    <?php print($errors['body'] ? 'class="error"' : '');?>
      <?php if ($values['body']=='4') print 'checked';?>              
    />
      4</label><br />
    <label><input type="radio"
      name="body" value="5" 
    <?php print($errors['body'] ? 'class="error"' : '');?>
      <?php if ($values['body']=='5') print 'checked';?>              
    />
      5</label><br />
    <label>
      Сверхспособности
      <br />
      <select name="ability[]"
          multiple="multiple" <?php print($errors['ability'] ? 'class="error"' : '');?>>
          <option value="1" <?php print(in_array('1', $values['ability']) ? 'selected ="selected"' : '');?>>бессмертие</option>
          <option value="2" <?php print(in_array('2', $values['ability']) ? 'selected ="selected"' : '');?>>прохождение сквозь стены</option>
          <option value="3" <?php print(in_array('3', $values['ability']) ? 'selected ="selected"' : '');?>>левитация</option>
          <option value="4" <?php print(in_array('4', $values['ability']) ? 'selected ="selected"' : '');?>>не чувствовать боль</option>
      </select>
      </label><br />
      <label>
      Биография<br />
        <textarea name="biographiya"
        <?php print($errors['biographiya'] ? 'class="error"' : '');?>
        ><?php print $values['biographiya'];?></textarea>
        </label><br />    
      <label><input type="checkbox" checked="checked"
        name="check" />
        Ознакомился с контрактом</label>
      <input type="submit" value="Отправить" />
    </form>
  </div>
</body>
</html>
