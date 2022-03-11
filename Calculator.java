import java.awt.*;
import java.awt.event.*;

import javax.script.ScriptEngine;
import javax.script.ScriptEngineManager;
import javax.script.ScriptException;


public class Calculator extends WindowAdapter  {
    ScriptEngineManager manager = new ScriptEngineManager();
    ScriptEngine engine = manager.getEngineByName("js");
    TextField calcInput;
    Calculator() {
        
        int frSize = 400; 

        Frame fr = new Frame("Calculator Design");

        calcInput = new TextField();
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
            "C","CE","COS","*",
            "1","2","3","-",
            "4","5","6","+",
            "7","8","9","/",
            "","0","π","=",
        };

        // Number buttons
        for (int i = 0; i < buttons.length; i++) {
            String value = buttons[i]; 
            Button b = new Button(buttons[i]);
            btnContainer.add(b);
            b.addActionListener(new ActionListener() {
                @Override
                public void actionPerformed(ActionEvent e) {
                    String calcText = calcInput.getText();
                    if (value == "CE") {
                        calcInput.setText(calcText.substring(0, calcText.length() - 1));
                        return;
                    }else if (value == "C") {
                        calcInput.setText("");
                        return;
                    } else if (value  == "=" ){
                        calcInput.setText(evaluate(calcInput.getText()));
                        return;
                    } else if (value == "COS") {
                        calcInput.setText(Math.cos(Double.parseDouble((calcInput.getText()))) + "");
                        return;
                    } else if (value == "TAN") {
                        calcInput.setText(Math.tan(Double.parseDouble((calcInput.getText()))) + "");
                        return;
                    } else if (value == "π") {
                        calcInput.setText(Math.PI + "");
                        return;
                    }
                    calcInput.setText(calcInput.getText() + value);
                }
            });
        }

        fr.add(calcInput);
        fr.add(btnContainer);
        fr.setSize(frSize,frSize);
        fr.setLayout(null);
        fr.setVisible(true);
    }

    public static void main(String[] args) {
        new Calculator();
    }


    private String evaluate(String text){
        try {
            return this.engine.eval(text).toString();
        } catch (ScriptException e) {
            e.printStackTrace();
        }
        return "";
    }
}
