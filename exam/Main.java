
import java.util.Scanner;

public class Main {
    public static Scanner sc= new Scanner(System.in);

    public static final String ANSI_RESET = "\u001B[0m";
    public static final String ANSI_BLACK = "\u001B[30m";
    public static final String ANSI_RED = "\u001B[31m";
    public static final String ANSI_GREEN = "\u001B[32m";
    public static final String ANSI_YELLOW = "\u001B[33m";
    public static final String ANSI_BLUE = "\u001B[34m";
    public static final String ANSI_PURPLE = "\u001B[35m";
    public static final String ANSI_CYAN = "\u001B[36m";
    public static final String ANSI_WHITE = "\u001B[37m";
    public static final String CURRENCY = "₱";

    public static void printLine(){
        System.out.println("------------------------------------------------------");
    }
    public static void loading() throws InterruptedException {
        loading("Loading");
    }
    public static void loading(String name)  throws InterruptedException {
        animateText(name);
        for (int i = 0; i < 6; i++) {
            Thread.sleep(450);
            System.out.print(".");
  
        }
    }
    public static void animateText(String name)  throws InterruptedException {
        for (int i = 0; i < name.length(); i++) {
            Thread.sleep(10);
            System.out.print(name.charAt(i));
  
        }
    }

    public static void clearConsole() throws InterruptedException{
        // Clear console
        animateText("\033[H\033[2J");  
        System.out.flush();  
    }

    public static void redirectToMenu() throws InterruptedException{
        // Clear console
        Main.loading("Redirecting to menu");
    }


    public static void main(String[] args) throws InterruptedException{
        Main.clearConsole();

        MoneyMaker mm = new MoneyMaker();

        animateText("------------------------------------------------------\n");
        animateText(ANSI_YELLOW + "█░█░█ ▄▀█ █ ▀█▀   █▀▀ █▀█ █▀█   █▀▄▀█ █▀█ █▄░█ █▀▀ █▄█\n");
        animateText(ANSI_CYAN + "▀▄▀▄▀ █▀█ █ ░█░   █▀░ █▄█ █▀▄   █░▀░█ █▄█ █░▀█ ██▄ ░█░\n" + ANSI_RESET);
        animateText("------------------------------------------------------\n");
        
        System.out.println();
        animateText("Enter your " + ANSI_BLUE + "name: " + ANSI_RESET);

        String name = sc.nextLine();
        User user = new User(name);

        animateText("\nWelcome, " + ANSI_YELLOW + user.name + "!\n\n" + ANSI_RESET );
        
        Main.redirectToMenu();

        mm.promptUser(user);

        sc.close();
    }
  }