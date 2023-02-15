import java.sql.ResultSet;

class User {
    String name;
    float money = 0;
    public User(String name) {

        this.name = name.trim(); // trim to remove whitespace on both sides

        try {
            ResultSet result = Main.db.query("SELECT * FROM user WHERE name='" + this.name.toLowerCase() + "'");
            if (result.next()) {
                this.name = result.getString("name");
                this.money = result.getFloat("money");
            } else {
                Main.db.update("INSERT INTO `user` (`name`, `money`) VALUES ('" + this.name.toLowerCase() + "','" + this.money + "')");
            }
        } catch (Exception e) {
            System.out.println(e);
            System.exit(0);
        }
       
    }

    public void displayWallet() throws InterruptedException {
        Main.clearConsole();

        Main.animateText("\n Your money: "+ Main.ANSI_YELLOW + Main.CURRENCY + this.money + "\n\n" + Main.ANSI_RESET);

        Thread.sleep(300);
        Main.redirectToMenu();
    }

    public void withdraw() throws InterruptedException {
        Main.animateText("Your total money is: " + Main.ANSI_YELLOW + Main.CURRENCY + this.money + "\n\n" + Main.ANSI_RESET);
        
        Main.animateText("Amount to be Withdrawn: ");
        float amountToWithdraw = Main.sc.nextFloat();

        Main.loading("\nProcessing");

        if (this.money < amountToWithdraw) {
            Main.animateText(Main.ANSI_RED + "\n\nYou don't have enough money to withdraw " + Main.ANSI_YELLOW + amountToWithdraw + Main.ANSI_RED + " pesos \n\n" + Main.ANSI_RESET );
            Thread.sleep(700);
        } else {
            this.money -= amountToWithdraw;
            try {
                Main.db.update("UPDATE `user` SET `money` = " + this.money + " WHERE `user`.`name` = '"+ this.name.toLowerCase() + "'");
            } catch (Exception e) {
                System.out.println(e);
                System.exit(0);
            }
            Main.animateText(Main.ANSI_GREEN + "\n\nYou successfully withdrawn "+ Main.ANSI_YELLOW + amountToWithdraw + Main.ANSI_RESET + "\n\n");
            Thread.sleep(700);
        }

        Main.redirectToMenu();
    }
}