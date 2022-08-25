
# Week 2 act 1 - Linear
array_len = int(input('Enter length of array: '))

input_list = []
for i in range(array_len):
    user_input = input(f'Enter the value of index {i}: ')
    input_list.append(user_input)

print(' '.join(input_list))