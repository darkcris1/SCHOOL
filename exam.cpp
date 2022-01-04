#include <iostream>
using namespace std;

// string inquire(string question){
//     string answer;
//     cout << question;
//     cin >> answer;
//     cout << "\n";
//     return answer;
// }

// int main(){
//     string question1 = "Enter your first number(range:0-13): ";
//     string question2 = "Enter your second number(range:0-13): ";

//     string answer1 = inquire(question1);
//     string answer2 = inquire(question1);
//     string answer3 = inquire(answer1 + " + " + answer2 + " = ");

//     string answer4 = inquire("What is the " + answer3 + " Letter of the Alphabet: "  );

//     string answer5 = inquire("Enter a decimal number(range1.1-26.9): "  );
//     string answer6 = inquire(answer3 + "x" + answer5 + " = ");

//     cout << "The " << answer3 << " letter of alphabet is: " << answer4 << "\n";
//     cout << "The Final answer of multiplication midterm exam is: " << answer6;
// }


int main() {
    int range2,range1, rangeAnswer;
    char alphabetLetter;
    float decimalRange, multiAnswer;
    
    cout << "Enter your first number(range:0-13): ";
    cin >> range1;
    cout << "\n";

    cout << "Enter your second number(range:0-13): ";
    cin >> range2;
    cout << "\n";

    cout << range1 << " + " << range2 << " = "; 
    cin >> rangeAnswer;
    cout << "\n";   

    cout << "What is the " << rangeAnswer <<  " Letter of alphabet? ";
    cin >> alphabetLetter;
    cout << "\n";

    cout << "Enter a decimal number(range1.1-26.9): ";
    cin >> decimalRange;
    cout << "\n";

    cout << rangeAnswer << "x" << decimalRange << " = "; 
    cin >> multiAnswer;
    cout << "\n";


    cout << "The " << rangeAnswer << " letter of alphabet is: " << alphabetLetter << "\n";
    cout << "The Final answer of multiplication midterm exam is: " << multiAnswer;
}