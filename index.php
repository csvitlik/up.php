<!DOCTYPE html><html><head><meta charset="utf-8" /><title>Simple Uploader</title>
<style type="text/css">*{font-family:"Helvetica","Arial",sans-serif,serif;font-size:14pt;line-height:14pt}
#content{padding:1em}input{padding:1em}
td{border: solid black 1px;margin:0 auto;padding:1em}
table{border: solid black 1px;margin:0 auto} input{text-align:left}
</style></head><body><div class="content" id="content">
<?php // Input Form
      $html_form = <<<EOD
<form action="%s" enctype="multipart/form-data" method="post"><table cellspacing="0" cellpadding="0">
<tr><td>File</td><td><input name="file" type="file" /></td></tr>
<tr><td>Login</td><td><input name="password" type="password" value="Password" /></td></tr>
<tr><td colspan="2"><input name="submit" type="submit" value="Submit" /></td></tr></table></form>\n
EOD;
    // base upload directory
    $upload_dir = 'h/';
    // `$ok` will be set to `true` if `move_uploaded_file` was successful.
    // Otherwise, it remains `false`, and we output $html_form.
    $ok = false;
    if (isset ($_POST['submit']) && $_POST['password'] == 'assword')
    { $target_file = $upload_dir . basename ($_FILES['file']['name']);

      // Case sensitive php extension check
      $is_php = substr($target_file, -3, 3);
      if ($is_php === 'php')
      { $target_file = $upload_dir . basename ($_FILES['file']['name']) . '.txt'; }

      // Append sha1sum if `file_exists`
      if (file_exists ($target_file))
      { $path_info = pathinfo($target_file);
        $path_ext = '';
        if ($path_info['extension'])
        { $path_ext = '.' . $path_info['extension']; }
        // New filename
        $target_file = sprintf ('%s/%s-%s%s',
            $path_info['dirname'],
            $path_info['filename'],
            sha1 (time ()),
            $path_ext); }

      // Move the uploaded file, change the group, and the mode
      if (move_uploaded_file ($_FILES['file']['tmp_name'], $target_file) &&
          chgrp ($target_file, 'www-data') &&
          chmod ($target_file, 0644))
      { // Done
        $ok = true; } }

    if ($ok)
    { $url = 'https://medusahead.net/' . htmlentities ($target_file);
      printf ('<a href="%s">%s</a>', $url, $url); }
    else
    { printf ($html_form, $_SERVER['SCRIPT_NAME']);
      } ?></div></body></html>
