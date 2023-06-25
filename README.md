# NFT Cod Task

NFT is a command-line tool for performing mathematical operations on CSV files.

## Features

- Supports various mathematical operations: addition, subtraction, multiplication, and division.
- Reads input data from a CSV file.
- Performs the specified action on each row of the CSV file.
- Logs the results and any errors encountered during the process.
- Writes the results to a new CSV file.

## Installation

1. Clone the repository to your local machine:

   ```
   git clone https://github.com/ibehnoosh/NFT.git
   ```

2. Navigate to the project directory:

   ```
   cd NFT
   ```

3. Install dependencies using Composer:

   ```
   composer install
   ```

## Usage

1. Prepare a CSV file with the input data. Each row should contain two numbers separated by a semicolon (`;`).

2. Run the CSV Command tool using the following command:

   ```
   php console.php <Action> <File>
   ```

   Replace `<Action>` with the desired mathematical operation (`plus`, `minus`, `multiply`, or `division`), and `<File>` with the path to your CSV file.

   Example:

   ```
   php console.php plus test.csv
   ```

3. The tool will process each row in the CSV file, perform the specified action, and generate a new CSV file with the results.

4. After execution, the tool will display the paths to the result file and log file.

## Validators

The tool supports validators that can be used to validate the input data before processing. Validators are implemented as classes that implement the `ValidatorInterface`. To add custom validators, create a new class that implements the interface and add it to the `validators` array in the `CSVCommand` class by `setValidator` method.

## Tests

The project includes unit tests  to ensure the correctness of the functionality. You can run the tests using the following command:

```
vendor/bin/phpunit
```
## ToDo

- Add support for additional mathematical operations. 
- Implement a command-line option to specify the output directory for result and log files. 
- Provide a Dockerfile for easy deployment and running of the tool (Right now because of internet restriction I couldn't build it). 
- Add support for reading and writing other file formats, such as Excel files. 
- Implement a progress indicator to show the status of the processing. 
- Enhance the command-line interface with additional options and interactive prompts.
- Implement support for parallel processing to improve performance. 
- ...



### Note
For me, software engineering is not only about Coding, Designing or Testing, it’s a lifestyle based on logic, learning, sharing,  problem-solving, empathy, and full of fun and bugs!🚀🐛
