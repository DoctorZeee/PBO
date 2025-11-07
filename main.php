<?php

require_once "collection.php";

//Contoh penggunaan Array
echo "1. ARRAY (Native PHP) \n"; 
$arr = [1, 2, 3];
$arr[] = 4; // Tambah elemen
$arr[0] = "text"; // Tidak ada type safety
echo "Array: " . print_r($arr, true);

//Contoh penggunaan colection framework
echo "2. COLLECTION (OOP) \n";
$list = new ArrayList();
$list->add(1);
$list->add(2);
$list->add(3);
$list->add(4);
echo "ArrayList size: " . $list->size() . "\n";
echo "ArrayList: " . print_r($list->toArray(), true);

//Pemanggilan ArrayList Linkedlist Stack Queue HashMap Iterator
echo "ArrayList \n";
$arrayList = new ArrayList();
$arrayList->add("Java");
$arrayList->add("PHP");
$arrayList->add("Python");
echo "Size: " . $arrayList->size() . "\n";
echo "Get index 1: " . $arrayList->get(1) . "\n";
echo "Contains 'PHP': " . ($arrayList->contains("PHP") ? "Yes" : "No") . "\n\n";

echo "LinkedList \n";
$linkedList = new LinkedList();
$linkedList->addFirst("First");
$linkedList->addLast("Last");
$linkedList->add("Middle");
echo "Size: " . $linkedList->size() . "\n";
echo "Elements: " . implode(", ", $linkedList->toArray()) . "\n\n";

echo "Stack (LIFO) \n";
$stack = new Stack();
$stack->push("Page 1");
$stack->push("Page 2");
$stack->push("Page 3");
echo "Peek: " . $stack->peek() . "\n";
echo "Pop: " . $stack->pop() . "\n";
echo "After pop, peek: " . $stack->peek() . "\n\n";

echo "Queue (FIFO) \n";
$queue = new Queue();
$queue->enqueue("Customer 1");
$queue->enqueue("Customer 2");
$queue->enqueue("Customer 3");
echo "Peek: " . $queue->peek() . "\n";
echo "Dequeue: " . $queue->dequeue() . "\n";
echo "After dequeue, peek: " . $queue->peek() . "\n\n";

echo "HashMap \n";
$hashMap = new HashMap();
$hashMap->put("nim", "123456");
$hashMap->put("nama", "Budi");
$hashMap->put("jurusan", "Informatika");
echo "Get 'nama': " . $hashMap->get("nama") . "\n";
echo "Contains key 'nim': " . ($hashMap->containsKey("nim") ? "Yes" : "No") . "\n";
echo "All keys: " . implode(", ", $hashMap->keys()) . "\n\n";

echo "Iterator \n";
$iterator = new CollectionIterator($arrayList);
echo "Iterating ArrayList: ";
while ($iterator->hasNext()) {
    echo $iterator->next() . " ";
}
echo "\n\n";

function printCollectionInfo(CollectionInterface $collection, string $name): void
{
    echo "Collection: $name\n";
    echo "Size: " . $collection->size() . "\n";
    echo "Empty: " . ($collection->isEmpty() ? "Yes" : "No") . "\n";
    echo "Elements: " . implode(", ", $collection->toArray()) . "\n";
    echo "---\n";
}

printCollectionInfo($arrayList, "ArrayList");
printCollectionInfo($stack, "Stack");
printCollectionInfo($queue, "Queue");

?>