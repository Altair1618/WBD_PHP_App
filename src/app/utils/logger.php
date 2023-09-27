<?php

class Logger
{
  private static function write_log(string $level, string $source_file, string $line_number, string $msg): bool
  {
    $file = fopen($_ENV["LOG_FILE"], "a");
    if ($file === false) {
      echo "Unable to open file `" . $_ENV["LOG_FILE"] . "`";
      return false;
    }
    $msg = "[" . date("Y-m-d H:i:s") . "] $level $source_file:$line_number: $msg\n";
    fwrite($file, $msg);
    fclose($file);
    return true;
  }

  public static function error(string $source_file, string $line_number, string $msg): bool
  {
    return Logger::write_log("ERROR", $source_file, $line_number, $msg);
  }

  public static function warn(string $source_file, string $line_number, string $msg): bool
  {
    return Logger::write_log("WARNING", $source_file, $line_number, $msg);
  }

  public static function info(string $source_file, string $line_number, string $msg): bool
  {
    return Logger::write_log("INFO", $source_file, $line_number, $msg);
  }

  public static function debug(string $source_file, string $line_number, string $msg): bool
  {
    return Logger::write_log("DEBUG", $source_file, $line_number, $msg);
  }
}
