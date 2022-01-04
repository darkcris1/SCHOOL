#include <iostream>
using namespace std;

string inquire(string question){
    string answer;
    cout << question;
    cin >> answer;
    cout << "\n";
    return answer;
}

int main() {
    string question1 = "What is the First Letter of your name ? ";
    string question2 = "3-2=";
    string question3 = "3.4+3.5=";
    string question4 = "500.05*2=";

    string answer1 = inquire(question1);
    string answer2 = inquire(question2 + "? ");
    string answer3 = inquire(question3 + "? ");
    string answer4 = inquire(question4 + "? ");

    cout << "\n\n"; // endl is redundant

    cout << "The first letter of my name is: " << answer1 << "\n";
    cout << question2  << " " << answer2 << "\n";
    cout << question3  << " " << answer3 << "\n";
    cout << question4  << " " << answer4 << "\n";

    return 0;
}