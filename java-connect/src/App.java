import java.sql.*;
import java.util.Scanner;


//  https://www.geeksforgeeks.org/java-database-connectivity-with-mysql/
public class App {

    public static void main(String[] args) throws Exception {
        Connection connection = null;
        Scanner sc = new Scanner(System.in);
        
        int select;

        try {
            // below two lines are used for connectivity.
            Class.forName("com.mysql.cj.jdbc.Driver");
            connection = DriverManager.getConnection(
                "jdbc:mysql://localhost/school",
                "root", "");
 
            Statement statement;
            statement = connection.createStatement();

            System.out.println("Options ");
            System.out.println("1. Add Student ");
            System.out.print("Select an action: ");
            select = sc.nextInt();

            switch (select) {
                case 1:
                    System.out.print("Enter student name: ");
                    sc.nextLine();
                    String name = sc.nextLine();
                    System.out.print("Enter student age: ");
                    int age = sc.nextInt();

                    statement.executeUpdate("INSERT INTO `student` (`name`, `age`) VALUES ('" + name + "', '" +  age + "')");

                    System.out.println("You successfully added the student ");
                    break;
                case 2:
                    break;
            }

            statement.close();
            connection.close();
        }
        catch (Exception exception) {
            System.out.println(exception);
        }

        sc.close();
    }
}
