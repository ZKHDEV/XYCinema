<?php
function upload()
{
  if ((($_FILES["file"]["type"] == "image/gif")
  || ($_FILES["file"]["type"] == "image/jpeg")
  || ($_FILES["file"]["type"] == "image/png")
  || ($_FILES["file"]["type"] == "image/pjpeg"))
  && ($_FILES["file"]["size"] < 5*1024*1024))
  {
    if ($_FILES["file"]["error"] > 0)
    {
      echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
      die;
      }
    else
    {
    // if (file_exists("upload/" . $_FILES["file"]["name"]))
    //   {
    //   echo $_FILES["file"]["name"] . " already exists. ";
    //   die;
    //   }
    // else
    //   {
      $ext = substr($_FILES["file"]["name"],strrpos($_FILES["file"]["name"],'.'));
      $filename = md5(time() . mt_rand(1,1000000)).$ext;
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $filename);
      return $filename;
      // }
    }
  }
  else
  {
    echo "Invalid file";
    die;
  }
}