class Stack:
  def __init__(self):
    self.list = []

  def push(self,item):
    self.list.append(item)

  def peek(self):
    for item in self.list[::-1]:
      print(item)

  def is_empty(self):
    return len(self.list) == 0

  def count(self):
    return len(self.list)

  def remove(self,item):
    self.list.remove(item)


# Test Case
stack = Stack() # initialize stack class

stack.push(1)
stack.push(2)
stack.push(3)

# check if the item has been pushed
stack.peek()


# Check if stack is empty
print(stack.is_empty())

# Check the count of stack, expected to be 3
print(stack.count())

# Check if the stack is removed on the stack
print(stack.remove(2))

# expected 2 items, because the 2 has been removed
print(stack.list)