#include <iostream>
using namespace std;

string string_asker(string question = "", string divider = "");

string string_asker(string question,string divider){
    string str;
    cout << question;
    cin >> str;
    cout << divider;
    return str;
}



int main(){
    string firstName = string_asker("Enter your first name: ");
    string middleName = string_asker("Enter your first name: ");
    string lastName = string_asker("Enter your first name: ");

    string domain = "gmail.com";
    string email = firstName + firstName[0] + middleName[0] + lastName[0] + "@" + domain;

    cout << "Hello! " << firstName << " " << middleName << " " << lastName << "\n";
    cout << "Your email now is: " << email << "\n";
}