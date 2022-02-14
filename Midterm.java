import java.util.Scanner;

public class Midterm {

    public static void runDataTypes() {
        char c = 'C';
        char r = 'R';
        char i = 'I';
        char s = 'S';

        System.out.println(c + "" + r+ "" + i + "" + s + "");

        int x = 5;
        int xy = 3;
        
        int m = 7;
        int mn = 4;
        
        double t = 20;
        double tu = 7;
        
        float y = 11;
        float yz = 3;

        // add 
        System.out.println(x + "+" + xy + "=" + (x+ xy));

        // sub
        System.out.println(m + "-" + mn + "=" + (m - mn));

        // times
        System.out.println(t + "*" + tu + "=" + (t * tu));

        // div
        System.out.println(y + "/" + yz + "=" + (y / yz));
    }   


    public static void operationSystem(){
        Scanner s = new Scanner(System.in);

        System.out.println("1. Addition(+) ");
        System.out.println("2. Subtraction(-) ");
        System.out.println("3. Multiply(*) ");
        System.out.println("4. Divide(/) ");
        
        System.out.print("Select your operation: ");
        int operation = s.nextInt();

        System.out.print("Enter a number: ");
        float num1 = s.nextInt();
        System.out.print("Enter a number: ");
        float num2 = s.nextInt();

        switch (operation) {
            case 1:
                System.out.println(num1 +  " + " + num2 + "= " + (num1 + num2) );
                break;
            case 2:
                System.out.println(num1 +  " - " + num2 + "= " + (num1 - num2) );
                break;
            case 3:
                System.out.println(num1 +  " x " + num2 + "= " + (num1 * num2) );
                break;
            case 4:
                System.out.println(num1 +  " / " + num2 + "= " + (num1 / num2) );
                break;
            default:
                System.out.println("Wrong operation");
        }
        s.close();
    }

    public static void periodicTable(){
        System.out.println("Welcome to Periodic Table! \n" );

        Scanner s = new Scanner(System.in);

        int given, limit;

        System.out.print("Enter a number: ");
        given = s.nextInt();
        System.out.print("Enter a limit: ");
        limit = s.nextInt();
        
        System.out.println();

        System.out.println("1. Addition(+) ");
        System.out.println("2. Subtraction(-) ");
        System.out.println("3. Multiply(*) ");
        System.out.println("4. Divide(/) ");
        
        System.out.print("Select your operation: ");
        int operation = s.nextInt();


        for (int i = 1; i <= limit; i++) {
            switch (operation) {
                case 1:
                    System.out.println(given + " x " + i + " = " + (given + i) );
                    break;
                case 2:
                    System.out.println(given + " - " + i + " = " + (given - i) );
                    break;
                case 3:
                    System.out.println(given + " * " + i + " = " + (given * i) );
                    break;
                case 4:
                    System.out.println(given + " * " + i + " = " + (given / i) );
                    break;
            }
        }
        
        s.close();
    }


    public static void stringLoop(){
        Scanner s = new Scanner(System.in);

        System.out.println("Welcome to String Loop!\n" );
        
        String[] usernames = {"darkcris1", "darkcris2","darkcris3","darkcris4"};
        String[] passwords = {"password1", "password2","password3","password4"};

        System.out.print("Enter username: " );
        String name = s.nextLine();
        System.out.print("Enter password: " );
        String pass = s.nextLine();
        s.close();
        
        for (int i = 0; i < usernames.length; i++) {
            if (name.equals(usernames[i])  && pass.equals(passwords[i])) {
                System.out.println("Welcome " + usernames[i]);
                return; // return immediately if found
            }
        }

        System.out.println("Wrong account");
    }

    public static void main(String[] args) {
        Scanner s = new Scanner(System.in);

        System.out.println("Welcome to Midterm Examination. Choose your function number");
        
        // Questions
        System.out.println("1. Function Variables Datatypes");
        System.out.println("2. Operation System");
        System.out.println("3. Periodic table");
        System.out.println("4. Enter a String Loop");

        System.out.print("Enter your number: ");
        int choosen = s.nextInt();

        System.out.println();
        
        switch (choosen) {
            case 1:
                runDataTypes();
                break;
            case 2:
                operationSystem();
                break;
            case 3:
                periodicTable();
                break;
            case 4:
                stringLoop();
                break;
            default:
                System.out.println("Wrong operation.");
        }
        s.close();
    }
}
