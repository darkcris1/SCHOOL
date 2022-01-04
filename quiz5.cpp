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
    string operators[4] = {"+","-","*","/"};
    string operators_name[4] = {"Addition","Subtraction","Multiply","Division"};
    cout << "Please select the number for the operation system \n";
    for (int i = 0; i < 4; i++){
        cout << (i + 1) << "." << operators_name[i] << operators[i] << "\n";
    }

    int operation = float_asker("Enter your number: ");

    if (operation <= 4 && operation >= 1) {
        float first_num = float_asker("Enter your first number: ");
        float second_num = float_asker("Enter your second number: ","\n");
        float result = 0;

        switch (operation){
            case 1:
                result = first_num + second_num;
                break;
            case 2:
                result = first_num - second_num;
                break;
            case 3:
                result = first_num * second_num;
                break;
            case 4:
                result = first_num / second_num;
                break;
        }

        cout <<  first_num << operators[operation - 1] << second_num << "=" << result << "\n";
        return 0; // return immediately to avoid else {}
    } 

    cout << "Wrong Number! Please try again. \n\n";
    main(); // Recursively call the main if the condition not met
}