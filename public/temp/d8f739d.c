import java.util.Scanner; // import Scanner class
public class grepperjava {
    public static void main(String[] ARGS)
    {
        System.out.println("\nPlease enter a number, and the loop will iterate input times.");
        int input;
        Scanner var = new Scanner(System.in); // Create scanner object, so user-input may be read
        input = var.nextInt();
        var.close();

        for(int i = 0; i < input; i++)
        {
            System.out.println("This will print " + input + " times");
        }
    }
}