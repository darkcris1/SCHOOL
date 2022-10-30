import java.util.ArrayList;

class Stack {
    private ArrayList<String> list;

    /**
     * Constructor of stack
     * @param args
     */
    public Stack(){
        this.list = new ArrayList<String>();
    }

    /**
     * Add a string data on list
     * @param data
     */
    public void push(String data){
        this.list.add(data);
    }

    /**
     * tanan numbers ibaliktad niya from bottom to top
     * tapos e print 
     */
    public void peek(){
        for (int i = this.list.size() - 1; i >= 0; i-- ){
            System.out.println(this.list.get(i)); 
        }
    }

    public void count() {
        System.out.println(this.list.size());
    }

    // mag tanggal sya og item from the top
    public void remove() {
        this.list.remove(this.list.size() - 1);
    }

    public void isEmpty() {
        System.out.println(this.list.size() == 0);
    }

    public static void main(String[] args) {
        Stack stack = new Stack();

        System.out.println("ELEMENTS IN STACK:");
        stack.push("1");
        stack.push("2");
        stack.push("3");
        stack.push("4");
        stack.push("5");
        stack.peek();
        
        System.out.println("ITEMS INSIDE THE STACK:");
        stack.count();

        System.out.println("ITEMS INSIDE THE STACK:");
        stack.remove();
        stack.peek();
        
        System.out.println("CHECKING IF THE STACK IS EMPTY:");
        stack.isEmpty();
    }
}