#include <iostream>
using namespace std;

int float_asker(string question){
    int number;
    cout << question;
    cin >> number;
    return number;
}

int main(){

    int length = float_asker("Enter a number: (1-5 only): ");

    string numList[5] = {"wan","two","three","poor","payb"};

    for (int i = 0; i < length; i++){
        switch (i){
            default:
                cout << "Namba" << numList[i] << "\n";
        }
    }
}