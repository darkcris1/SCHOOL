import java.sql.*;


//  https://www.geeksforgeeks.org/java-database-connectivity-with-mysql/
public class App {
    public static void main(String[] args) throws Exception {
        Connection connection = null;
        try {
            // below two lines are used for connectivity.
            Class.forName("com.mysql.cj.jdbc.Driver");
            connection = DriverManager.getConnection(
                "jdbc:mysql://localhost/university",
                "root", "");
 
            // mydb is database
            // mydbuser is name of database
            // mydbuser is password of database
 
            Statement statement;
            statement = connection.createStatement();
            ResultSet resultSet;
            resultSet = statement.executeQuery(
                "select * from student");
            String name;
            String cl;
            while (resultSet.next()) {

                System.out.println("-------------------------");
                name = resultSet.getString("name");
                cl = resultSet.getString("class");
                System.out.println( "Student Number: " + resultSet.getInt("student_number")
                                    +"\nName: " + name
                                   + "\nClass: " + cl);
            }
            resultSet.close();
            statement.close();
            connection.close();
        }
        catch (Exception exception) {
            System.out.println(exception);
        }

    }
}
