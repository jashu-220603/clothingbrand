<?php
echo "<h2>PART A: PHP Variables & Scope</h2>";

/* ---------- Task A2: Datatypes ---------- */
$stringVar = "Hello PHP";
$intVar = 10;
$floatVar = 10.5;
$boolVar = true;
$arrayVar = array("PHP", "MySQL", "HTML");

echo "<h3>Datatypes</h3>";
echo "String: $stringVar <br>";
echo "Integer: $intVar <br>";
echo "Float: $floatVar <br>";
echo "Boolean: " . ($boolVar ? "True" : "False") . "<br>";
echo "Array: ";
print_r($arrayVar);
echo "<br><br>";

/* ---------- Task A3: Variable Scope ---------- */

/* 1. Local Scope */
function localScopeDemo() {
    $localVar = "I am Local Variable";
    echo "Local Scope: $localVar <br>";
}
localScopeDemo();

/* 2. Global Scope */
$globalVar = "I am Global Variable";

function globalScopeDemo() {
    global $globalVar;
    echo "Global Scope: $globalVar <br>";
}
globalScopeDemo();

/* 3. Static Scope */
function staticScopeDemo() {
    static $count = 0;
    $count++;
    echo "Static Variable Count: $count <br>";
}

echo "<h3>Static Scope (Refresh page)</h3>";
staticScopeDemo();
staticScopeDemo();
staticScopeDemo();
?>
<?php
echo "<h2>PART B: String Functions</h2>";

/* Task B2: String Source */
$text = "  Welcome to PHP String Functions  ";
$userInput = "php programming";

/* ---------- Basic String Functions ---------- */
echo "<h3>Basic String Functions</h3>";
echo "Length: " . strlen($text) . "<br>";
echo "Word Count: " . str_word_count($text) . "<br>";
echo "Reverse: " . strrev($text) . "<br>";

/* ---------- Case Conversion ---------- */
echo "<h3>Case Conversion</h3>";
echo strtoupper($userInput) . "<br>";
echo strtolower($userInput) . "<br>";
echo ucfirst($userInput) . "<br>";
echo ucwords($userInput) . "<br>";

/* ---------- Search & Replace ---------- */
echo "<h3>Search & Replace</h3>";
echo "Position of PHP: " . strpos($text, "PHP") . "<br>";
echo str_replace("PHP", "Web", $text) . "<br>";

/* ---------- Substring & Trimming ---------- */
echo "<h3>Substring & Trimming</h3>";
echo substr($text, 11, 3) . "<br>";
echo trim($text) . "<br>";
echo ltrim($text) . "<br>";
echo rtrim($text) . "<br>";

/* ---------- String Comparison ---------- */
echo "<h3>String Comparison</h3>";
echo strcmp("PHP", "php") . "<br>";
echo strcasecmp("PHP", "php") . "<br>";

/* ---------- Special Characters & Security ---------- */
echo "<h3>Security Functions</h3>";
$special = "<script>alert('Hack')</script>";
echo htmlspecialchars($special) . "<br>";
echo addslashes("I'm learning PHP") . "<br>";
?>
