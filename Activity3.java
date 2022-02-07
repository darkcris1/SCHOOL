import java.util.Scanner;

public class Activity3 {
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);


        System.out.print("Math : ");
        int math = sc.nextInt();

        System.out.print("C++ : ");
        int cpp = sc.nextInt();

        System.out.print("English : ");
        int eng = sc.nextInt();
        
        System.out.print("Java : ");
        int java = sc.nextInt();

        // Close scanner to avoid leak
        sc.close();
        System.out.println();

        int totalSubject = 4;
        float average = (cpp + math + eng + java) / totalSubject;

        System.out.println("Average :  " +  average + " ");
        
        if (average > 100) {
            System.out.println("Invalid Grade");
        } else if (average > 95){
            System.out.println("Candidate");
        } else if (average > 90) {
            System.out.println("With Honors");
        } else if (average == 90) {
            System.out.println("Honorable");
        } else if (average >= 80){
            System.out.println("Average Passer");
        } else if (average > 75) {
            System.out.println("Passed");
        } else {
            System.out.println("Failed");
        }
    }
}
