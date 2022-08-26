
# Week 2 act 1 - Linear
array = [1,3,4,5,2,1]

current_index = 0
for i in array:
    arr_copy = array.copy()
    arr_copy.pop(current_index)
    if i in arr_copy:
        print(True)
        break
    else:
        print(False)