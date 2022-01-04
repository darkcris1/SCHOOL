#include <iostream>
#include <string>
using namespace std;

string string_asker(string question = "", string divider = "");

string string_asker(string question,string divider){
    string str;
    cout << question;
    getline(cin,str);
    return str;
}



int main(){
    int maxChar = 12;


    string name = string_asker("Enter your username: ");
    int nameLen  = name.length();

    if (nameLen == 0) { // required validator
        cout << "You didn't enter a name!"; 
        return 0;
    } else if (nameLen > maxChar){ // maximum length validator
        cout << "Your name can't be over " << maxChar <<  " characters long"; 
        return 0;
    }

    cout << "Welcome " << name << "\n";
}