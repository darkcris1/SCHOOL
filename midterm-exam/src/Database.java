import java.sql.*;

// Create database class ro reuse the connection
class Database {
    Connection connection = null;
    Statement statement;


    private void msgIfNoConnection(){
        if (this.connection == null) {
            System.out.println("connect to the database first");
            System.exit(0);
        }
    }
    public Database() {
        try {
            //  https://www.geeksforgeeks.org/java-database-connectivity-with-mysql/
            Class.forName("com.mysql.cj.jdbc.Driver");
            this.connection = DriverManager.getConnection(
                "jdbc:mysql://localhost/cris_exam",
                "root", "");
        }catch (Exception exception) {
            System.out.println(exception);
        }
    }

    public void update(String str) throws Exception {
        this.msgIfNoConnection();
        this.statement = connection.createStatement();
        this.statement.executeUpdate(str);
    }

    public ResultSet query(String str) throws Exception  {
        this.msgIfNoConnection();
        this.statement = connection.createStatement();
        ResultSet result = statement.executeQuery(str);
        return result;
     
    }

    public void destroy(){
        if (this.connection != null) {
            try {
                 this.connection.close();
                 this.statement.close();
            }
            catch (Exception exception) {
                System.out.println(exception);
            }
        }
    }
}
