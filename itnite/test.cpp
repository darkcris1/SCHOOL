#include <iostream>
using namespace std;

void calculate(int operation, double num1, double num2) {
  if (operation == 1) {
    cout << num1 << " + " << num2 << " = " << (num1 + num2) << endl;
  } else if (operation == 2) {
    cout << num1 << " - " << num2 << " = " << (num1 - num2) << endl;
  } else if (operation == 3) {
    cout << num1 << " * " << num2 << " = " << (num1 * num2) << endl;
  } else if (operation == 4) {
    cout << num1 << " / " << num2 << " = " << (num1 / num2) << endl;
  }
}

int main() {
  string username, password;

  cout << "Enter username: ";
  cin >> username;
  cout << "Enter password: ";
  cin >> password;

  string credentials[3][2] = {
      {"Admin", "@dmin123"},
      {"user", "user456"},
      {"itnite", "ITNite"},
  };
  int index = -1; // initial value if invalid credentials
  for (int i = 0; i < sizeof(credentials); i++) {
    if (credentials[i][0] == username) {
      index = i;
      break;
    }
  }
  if (index < 0) {
    cout << "Wrong username! Run system Again";
    return 0;
  }
  if (credentials[index][1] != password) {
    cout << "Wrong password! Run system Again";
    return 0;
  }

  int periodic, operation;

  cout << "Welcome " << username << "! \n";
  cout << "1. Add two numbers (-*/+)\n";
  cout << "2. Periodic table \n";

  cout << "Enter a number: ";
  cin >> periodic;

  cout << endl;

  cout << "1. Addition + \n";
  cout << "2. Subtraction - \n";
  cout << "3. Multiply * \n";
  cout << "4. Divide / \n";
  cout << "Enter number: ";
  cin >> operation;

  cout << endl;

  if (periodic == 1) {
    double num1, num2;
    cout << "Enter a number: ";
    cin >> num1;
    cout << "Enter a number: ";
    cin >> num2;
    calculate(operation, num1, num2);
    
  } else if (periodic == 2) {
    double num1, limit;
    cout << "Enter a number: ";
    cin >> num1;
    cout << "Enter the limit: ";
    cin >> limit;
    for (int i = 1; i <= limit; i++) {
      calculate(operation, num1, i);
    }
  } else {
    cout << "Wrong number! Run system again";
  }
}