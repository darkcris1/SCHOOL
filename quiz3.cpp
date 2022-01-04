#include <iostream>
using namespace std;

float float_asker(string question){
    float number;
    cout << question;
    cin >> number;
    return number;
}

string string_asker(string question){
    string answer;
    cout << question;
    getline(cin,answer);
    return answer;
}

int main(){

    string name = string_asker("Please enter your name: \n");
    cout << "Welcome " << name << " \n";

    float total = 0;
    int length = 4;

    for (int i = 0; i < length; i++){
        total += float_asker("Enter number: "); // Compute total per input
    }

    // Compute average using total and its n of inputs    
    float average = total / length;

    cout << "Average = " << average << "\n"; 
}