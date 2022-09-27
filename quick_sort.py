def quick_sort(array):
    elements = len(array)
    
    if elements < 2:
        return array
    
    current_index = 0 

    for i in range(1, elements):
        if array[i] <= array[0]:
            current_index += 1
            temp = array[i]
            array[i] = array[current_index]
            array[current_index] = temp

    temp = array[0]
    array[0] = array[current_index] 
    array[current_index] = temp
    
    left = quick_sort(array[0:current_index])
    right = quick_sort(array[current_index+1:elements])

    array = left + [array[current_index]] + right
    
    return array


print(quick_sort([5,4,8,4,1,2,3])) # [1, 2, 3, 4, 4, 5, 8]
