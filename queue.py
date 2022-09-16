class Queue:

    def __init__(self):
        self.list = []

    def enqueue(self, data):
        self.list.append(data)

    def dequeue(self):
        self.list.pop(0)

    def front(self):  # print the first element in queue
        print(self.list[0])

    def rear(self):  # print the last element in queue
        print(self.list[-1])

    def is_empty(self):
        print(len(self.list) == 0)

    def count(self):
        print(len(self.list))


# Test Case
queue = Queue()

queue.enqueue('A')
queue.enqueue('B')
queue.enqueue('C')
queue.enqueue('D')

print(queue.list)  # expected to be an array with item of A,B,C,D

queue.front()  # expected to to print an A
queue.rear()  # expected to to print a D

queue.count()  # expected to be 4

queue.is_empty()  # expected to be false

queue.dequeue() 
print(queue.list)  # expected to be an array with item of B,C,D since we remove the first item using dequeue


queue.enqueue('E') 
print(queue.list) # expected to be an array with item of B,C,D, E since we enque the letter E