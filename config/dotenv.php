<?php
/**
 * Simple .env loader for PHP without Composer.
 */
class Dotenv
{
    /**
     * Load and parse a .env file into PHP environment.
     *
     * @throws Exception if file not found or unreadable.
     */
    private string $path = "/srv/website/.env";
    public static function load(string $path): void
    {
        if (!is_readable($path)) {
            throw new Exception("Dotenv: Unable to read the .env file at {$path}");
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            // Strip BOM, whitespace
            $line = trim($line, "\xEF\xBB\xBF \t");

            // Skip comments
            if ($line === '' || $line[0] === '#' || $line[0] === ';') {
                continue;
            }

            // Optional "export " prefix
            if (strpos($line, 'export ') === 0) {
                $line = substr($line, 7);
            }

            // Parse key and value
            if (!strpos($line, '=')) {
                continue;
            }

            list($name, $value) = explode('=', $line, 2);
            $name  = trim($name);
            $value = trim($value);

            // Remove surrounding quotes if present
            if (
                (strlen($value) >= 2)
                && (
                    ($value[0] === '"' && $value[-1] === '"')
                    || ($value[0] === "'" && $value[-1] === "'")
                )
            ) {
                $quote = $value[0];
                $value = substr($value, 1, -1);
                if ($quote === '"') {
                    // Interpret common escape sequences in double-quoted values
                    $value = strtr($value, [
                        '\n' => "\n",
                        '\r' => "\r",
                        '\t' => "\t",
                        '\\"' => '"',
                        '\\\'' => "'",
                        '\\\\' => '\\',
                    ]);
                }
            }

            // Set the environment variable
            putenv("{$name}={$value}");
            $_ENV[$name]    = $value;
            $_SERVER[$name] = $value;
        }
    }
}
