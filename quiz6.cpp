#include <iostream>
using namespace std;

float float_asker(string question = "", string divider = "");

float float_asker(string question,string divider){
    float number;
    cout << question;
    cin >> number;
    cout << divider;
    return number;
}



int main(){

    float number = float_asker("Enter a number: ");
    float limit = float_asker("Enter the limit number: ");

    for (int i = 1; i <= limit; i++){
        cout << number << " * " << i << " = " << number * i;
        cout << "\n";
    }
}