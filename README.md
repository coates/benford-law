# benford-law
Test a set of integers for compliance with Benford's Law.

## Goal:
Write a program in PHP/Laravel that takes a set of integers and decides whether those integers conform to Benford's Law (https://en.wikipedia.org/wiki/Benford%27s_law). Keep it simple and note the assumptions you make. Keep in mind that we’re not looking for precise statistical precision here. You shouldn’t need to incorporate statistics libraries or anything — just getting a reasonably accurate conclusion as to whether or not those integers conform is definitely sufficient. And again, if you need to make assumptions just note them appropriately. We will need some way to input a series of integers so that we can test conformity.

## Steps:
1. Research Benford's Law.
2. Create a method to read in a set of integers into a list.
3. Create a method to calculate the statistical distribution of the first digit of each integer in the list.
4. Create a method to calculate the Benford's Law distribution.
5. Create a method to compare the statistical distribution to the Benford's Law distribution. We'll need some kind of scoring mechanism.
6. Create a method to output the results of the comparison.

## Assumptions:
1. Although the requirement used the word 'set', I'm assuming that the input is a list of integers, and not a mathematical set. This means that the input can contain duplicate values, and the duplicates will be counted separately for the distribution. This may make more sense for real-world data, where the input is a list of numbers, and not a mathematical set, such as lengths of files or text strings.
2. The input data is a clean set of positive integers. No need to check for invalid data. If time permits, I'll add some validation.
3. The input file is a text file, with one integer per line. (A more interesting version might read a CSV and allow you to specify a column.)

## Scoring mechanism
Since the differences between the observed and expected distribution are much greater for digit 1 than for digit 9, I'm going to compute the percent margin for each digit as the difference betwen the observed and expected values, divided by the expected value (times 100 for being a percentage). Then the score will be the average of the margins for each digit. This will give a smaller score for a distribution that is closer to Benford's Law.

I've arbitrarily set a cutoff of 25% for the score. If the score is greater than 25%, then the distribution does not conform to Benford's Law.

## Benford's Law
A set of numbers is said to satisfy Benford's law if the leading digit d (d ∈ {1, ..., 9}) occurs with probability
  P(d) = log10(1 + 1/d)

# Usage
`php benford <file>`

If <file> is not specified, it defaults to random_numbers.txt.