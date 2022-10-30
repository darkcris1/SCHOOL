import java.util.ArrayList;

public class Queue {
    private ArrayList<String> list;

    /**
     * Constructor of Queue
     * @param args
     */
    public Queue(){
        this.list = new ArrayList<String>();
    }

    // Add an element
    public void enqueue(String item){
        this.list.add(item);
    }

    // Remove an element
    public String dequeue() {
        if (this.list.size() < 1) {
            return "None";
        }

        return this.list.remove(this.list.size() - 1);
    }

    /**
     * return front of list
     */
    public String front() {
        return this.list.get(0);
    }

    public String rear() {
        return this.list.get(this.list.size() - 1);
    }

    public void isEmpty() {
        System.out.println(this.list.size() == 0); 
    }

    public void count() {
        System.out.println(this.list.size()); 
    }

    public static void main(String[] args) {
        Queue queue = new Queue();
        queue.enqueue("1");
        queue.enqueue("2");
        queue.enqueue("3");
        queue.enqueue("4");
        queue.enqueue("5");

        System.out.println("Count of queue :");
        queue.count();

        System.out.println("FIRST ELEMENT IN THE QUEUE:");
        queue.front();

        System.out.println("LAST ELEMENT IN THE QUEUE:");
        queue.rear();
        
        System.out.println("THE ELEMENT THAT WAS REMOVED:");
        System.out.println(queue.dequeue());
        
        System.out.println("AFTER REMOVING AN ELEMENT:");
        queue.count();

        System.out.println("CHECKING IF THE QUEUE IS EMPTY:");
        queue.isEmpty();

    }
}
