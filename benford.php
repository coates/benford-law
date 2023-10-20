<?php
class Benford
{
    public function __construct($file_name)
    {
        $data = $this->load_file($file_name);

        $observed = $this->compute_first_digit_frequency($data);

        $expected = $this->benford_distribution();

        $this->print_results($observed, $expected);
    }

    private function load_file($filename) {
        $file = fopen($filename, 'r');
        if (!$file) {
            return "Could not open the file!";
        }
    
        $data = array();
        // future version could read in a CSV file
        while (($line = fgets($file)) !== false) {
            $data[] = intval($line);
            // we could add validation here later - check for non-numeric values, negative numbers, 0, blanks etc.
        }

        fclose($file);
        return $data;
    }
    
    private function compute_first_digit_frequency($data)
    {
        $frequency = [];
        for($i=1; $i<=9; $i++) {
            $frequency[$i] = 0;
        }
        foreach ($data as $element) {
            $first_digit = strval($element)[0];
                $frequency[$first_digit]++;
            
        }
        foreach ($frequency as $key => $value) {
            $frequency[$key] = 100.0 * $value / count($data);
        }
        ksort($frequency);
        return $frequency;
    }


    function benford_distribution() {
        $distribution = array();
    
        for ($d = 1; $d <= 9; $d++) {
            $distribution[$d] = 100.0 * log10(1 + 1/$d);
        }
    
        return $distribution;
    }
    
    function print_results($observed, $expected) {
        echo "Digit\tExpected\tObserved\tDifference\tMargin\n";
        echo "---------------------------------------------------------------\n";
    
        $margin_sum = 0;
        foreach ($observed as $digit => $frequency) {
            $difference = abs($frequency - $expected[$digit]);
            $margin = $difference / $expected[$digit] * 100.0;
            printf("%d\t%.2f%%\t\t%.2f%%\t\t%.2f%%\t\t%.2f%%\n", $digit, $expected[$digit], $frequency, $difference, $margin);
            $margin_sum += $margin;
        }
    
        echo "---------------------------------------------------------------\n";
        $score = $margin_sum / 9;
        printf("Score: %.2f (lower is better)\n", $score);

        if ($score < 25) {
            print("The data is close to following Benford's Law.\n");
        } else {
            print("The data is not following Benford's Law.\n");
        }
    }
}

if (isset($argv[1])) {
    $file = $argv[1];
} else {
    $file = 'random_numbers.txt';
}
$benford = new Benford($file);
?>
