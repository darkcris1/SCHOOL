import java.awt.*;


public class CalcDesign {
    public static void main(String[] args) {
        int frSize = 400; 

        Frame fr = new Frame("Calculator Design");

        TextField calcInput = new TextField();
        Container btnContainer = new Container();
            
        calcInput.setBounds(0,30,frSize,frSize / 6);

        // Calculate container x and y based on calcInput height and y
        int containerY = calcInput.getY() + calcInput.getHeight();
        int containerheight = frSize - containerY;

        btnContainer.setBounds(0,containerY,frSize,containerheight);

        // Set layout base on buttons model interface rows and column
        btnContainer.setLayout(new GridLayout(5,4));

        // Buttons Model interface
        String buttons[] = {
            "CE","TAN","COS","*",
            "1","2","3","-",
            "4","5","6","+",
            "7","8","9","/",
            ".","0","%","=",
        };

        // Number buttons
        for (int i = 0; i < buttons.length; i++) {
            Button b = new Button(buttons[i]);
            btnContainer.add(b);
        }

        fr.add(calcInput);
        fr.add(btnContainer);
        fr.setSize(frSize,frSize);
        fr.setLayout(null);
        fr.setVisible(true);
    }
}
