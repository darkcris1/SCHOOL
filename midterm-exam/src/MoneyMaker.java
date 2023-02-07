import java.util.Scanner;

class MoneyMaker {
    float moneyPerSecond = 5;

    int seconds;
    public void loading() throws InterruptedException {
        this.loading("Earning");
    }
    public void loading(String name)  throws InterruptedException {
        System.out.print(name);
        for (int i = 0; i < 6; i++) {
            Thread.sleep(100);
            System.out.print(".");
  
        }
        System.out.print(Main.ANSI_YELLOW + Main.CURRENCY);
    }

    public float earn()  throws InterruptedException {
        float totalEarned = 0;
        for (int i = 0; i < this.seconds; i++) {
            this.loading();
            System.out.print(this.moneyPerSecond + Main.ANSI_RESET + "\n");
            totalEarned += this.moneyPerSecond;
        }
        return totalEarned;
    }
    public void play(User user) throws InterruptedException {
        Scanner sc = new Scanner(System.in);

        Main.animateText("How long do your want to wait (" + Main.ANSI_BLUE + "seconds" + Main.ANSI_RESET + "): ");
        this.seconds = sc.nextInt();
        float total = this.earn();
        Main.animateText("You earned -> " + Main.ANSI_YELLOW + Main.CURRENCY + total + Main.ANSI_RESET);
        user.money += total;
        
        try {
            Main.db.update("UPDATE `user` SET `money` = " + user.money + " WHERE `user`.`name` = '"+ user.name.toLowerCase() + "'");
        } catch (Exception e) {
            System.out.println(e);
            System.exit(0);
        }

        System.out.println("\n");

        Main.redirectToMenu();
        this.promptUser(user);

        sc.close();
    }

    public void displayTransactions(){

    }

    public void promptUser(User user) throws InterruptedException {
        Main.clearConsole();

        int choice;
        
        Main.animateText("---------" + Main.ANSI_YELLOW +  "Menu" + Main.ANSI_RESET+ "--------- \n");
        System.out.println("1. Wait and Earn money");
        System.out.println("2. Withdraw");
        System.out.println("3. My Wallet");
        System.out.println("4. Exit");

        Main.animateText("\n What do you want to do " + user.name + " ? ");

        choice = Main.sc.nextInt();

        Main.clearConsole();
        switch (choice) {
            case 1:
                this.play(user);
                break;
            case 2:
                // Withdraw 
                user.withdraw();
                this.promptUser(user);
                break;
            case 3:
                user.displayWallet();
                this.promptUser(user);
                break;
            case 4:
                // Exit is nothing 
                break;
        }
    }
}