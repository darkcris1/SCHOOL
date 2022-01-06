#include <iostream>
using namespace std;

string string_asker(string question = "", string divider = "");

string string_asker(string question,string divider){
    string str;
    cout << question;
    getline(cin,str);
    return str;
}

bool validate(string text,string label){
    int maxChar = 12;
    int textLen = text.length();
    if (textLen == 0) { // required validator
        cout << "You didn't enter " << label << "\n"; 
        return false;
    }  
    if (textLen > maxChar){ // maximum length validator
        cout << "Your name can't be over " << maxChar <<  " characters long!\n"; 
        return false;
    }
    return true;
}



int main(){
    string middleLabel = "Middle!";
    string lastLabel = "Lastname!";
    string firstLabel = "First Name!";

    string firstName, middleName, lastName;

    firstName = string_asker("Enter your username: ");
    if (!validate(firstName, firstLabel)) {
        validate(middleName,middleLabel);
        validate(lastName,lastLabel);
        return 0;
    }
    
     middleName = string_asker("Enter your middle name: ");
    if (!validate(middleName, middleLabel)) {
        validate(lastName,lastLabel);
        return 0;
    }

    lastName = string_asker("Enter your last name: ");
    if (!validate(lastName, lastLabel)) {
        return 0;
    }

    string domain = "gmail.com";
    string email = firstName + firstName[0] + middleName[0] + lastName[0] + "@" + domain;

    cout << "Hello! " << firstName << " " << middleName << " " << lastName << "\n";
    cout << "Your email now is: " << email << "\n";
}