class Node:

    def __init__(self, data=None):
        self.value = data
        self.next = None


class LinkedList:

    def __init__(self):
        self.head = None

    def add_first(self, data):
        prev_first_head = self.head
        self.head = Node(data)
        self.head.next = prev_first_head

    def print_list(self):
        if self.head is None:
            return print('Linked list is empty')

        printval = self.head
        while printval is not None:
            print(printval.value)
            printval = printval.next


# Test Case
linked_list = LinkedList()

linked_list.add_first('O')
linked_list.add_first('P')
linked_list.add_first('A')
linked_list.add_first('W')
linked_list.add_first('G')

linked_list.add_first('\n')

linked_list.add_first('S')
linked_list.add_first('I')
linked_list.add_first('R')
linked_list.add_first('C')

linked_list.print_list()
