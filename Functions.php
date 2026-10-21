<?php

$name = " JANE_DOE@ComputerScience2026!!! ";

echo trim(strtolower(str_replace('ComputerScience','cs', str_replace('@', '_', str_replace('_', '.', str_replace('!', '', $name))))));

?>