class Stack:
  def __init__(self):
    self.list = []

  def push(self,item):
    self.list.append(item)

  def peek(self):
    for item in self.list[len(self.list)::-1]:
      print(item)

  def is_empty(self):
    return len(self.list) == 0

  def count(self):
    return len(self.list)

  def remove(self,item):
    self.list.remove(item)

stack = Stack()

stack.push(1)
stack.push(2)
stack.push(3)

stack.peek()
