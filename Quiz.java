import java.util.*;

public class Quiz {

    public static void main(String[] args) {
      Scanner sc = new Scanner(System.in);

      System.out.print("Enter first number => ");
      double num1 = sc.nextDouble();

      System.out.print("Enter second number => ");
      double num2 = sc.nextDouble();

      sc.close();
      
      System.out.println("Result => " + combination (num1, num2));
    }
    
    public static double factorial(double n) {
        if (n > 1 ) return n * factorial (n - 1);
        return n;
    }
    
    public static double combination (double n, double r) {
      return factorial(n) / (factorial(r) * (factorial(n-r)));
    }
}