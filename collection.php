<?php

/**
 * ============================================================================
 * PERBEDAAN ARRAY vs COLLECTION
 * ============================================================================
 * 
 * ARRAY (Built-in PHP):
 * - Struktur data bawaan PHP yang fleksibel
 * - Bisa menyimpan berbagai tipe data
 * - Tidak ada kontrak/interface yang jelas
 * - Tidak ada enkapsulasi, langsung akses elemen
 * - Tidak ada type safety
 * - Contoh: $arr = [1, 2, 3]; $arr[0] = "text";
 * 
 * COLLECTION (OOP Approach):
 * - Objek yang membungkus array dengan behavior tertentu
 * - Punya kontrak yang jelas lewat interface
 * - Ada enkapsulasi dan kontrol akses
 * - Ada validasi dan type safety
 * - Lebih maintainable dan testable
 * - Mendukung polymorphism
 * - Contoh: $list = new ArrayList(); $list->add(1);
 * 
 * ============================================================================
 */

// ==================== INTERFACES ====================

/**
 * CollectionInterface - Interface dasar untuk semua collection
 */
interface CollectionInterface
{
    public function size(): int;
    public function isEmpty(): bool;
    public function clear(): void;
    public function contains($element): bool;
    public function toArray(): array;
}

/**
 * ListInterface - Collection berurutan dengan akses index
 */
interface ListInterface extends CollectionInterface
{
    public function add($element): void;
    public function get(int $index);
    public function set(int $index, $element): void;
    public function remove(int $index): void;
    public function indexOf($element): int|false;
    public function addFirst($element): void;
    public function addLast($element): void;
}

/**
 * QueueInterface - FIFO (First In First Out)
 */
interface QueueInterface extends CollectionInterface
{
    public function enqueue($element): void;
    public function dequeue();
    public function peek();
}

/**
 * StackInterface - LIFO (Last In First Out)
 */
interface StackInterface extends CollectionInterface
{
    public function push($element): void;
    public function pop();
    public function peek();
}

/**
 * MapInterface - Penyimpanan key-value pairs
 */
interface MapInterface extends CollectionInterface
{
    public function put($key, $value): void;
    public function get($key);
    public function remove($key): bool;
    public function containsKey($key): bool;
    public function containsValue($value): bool;
    public function keys(): array;
    public function values(): array;
}

/**
 * IteratorInterface - Interface untuk iterasi custom
 */
interface CustomIteratorInterface
{
    public function hasNext(): bool;
    public function next();
    public function current();
    public function reset(): void;
}

// ==================== IMPLEMENTATIONS ====================

/**
 * ArrayList - Implementasi List menggunakan array dinamis
 */
class ArrayList implements ListInterface
{
    private array $elements = [];
    
    public function add($element): void
    {
        $this->elements[] = $element;
    }
    
    public function addFirst($element): void
    {
        array_unshift($this->elements, $element);
    }
    
    public function addLast($element): void
    {
        $this->add($element);
    }
    
    public function get(int $index)
    {
        if (!isset($this->elements[$index])) {
            throw new OutOfBoundsException("Index $index out of bounds");
        }
        return $this->elements[$index];
    }
    
    public function set(int $index, $element): void
    {
        if (!isset($this->elements[$index])) {
            throw new OutOfBoundsException("Index $index out of bounds");
        }
        $this->elements[$index] = $element;
    }
    
    public function remove(int $index): void
    {
        if (!isset($this->elements[$index])) {
            throw new OutOfBoundsException("Index $index out of bounds");
        }
        unset($this->elements[$index]);
        $this->elements = array_values($this->elements);
    }
    
    public function indexOf($element): int|false
    {
        return array_search($element, $this->elements, true);
    }
    
    public function contains($element): bool
    {
        return in_array($element, $this->elements, true);
    }
    
    public function size(): int
    {
        return count($this->elements);
    }
    
    public function isEmpty(): bool
    {
        return empty($this->elements);
    }
    
    public function clear(): void
    {
        $this->elements = [];
    }
    
    public function toArray(): array
    {
        return $this->elements;
    }
}

/**
 * Node untuk LinkedList
 */
class Node
{
    public $data;
    public ?Node $next;
    
    public function __construct($data)
    {
        $this->data = $data;
        $this->next = null;
    }
}

/**
 * LinkedList - Implementasi List menggunakan linked nodes
 */
class LinkedList implements ListInterface
{
    private ?Node $head = null;
    private int $count = 0;
    
    public function add($element): void
    {
        $this->addLast($element);
    }
    
    public function addFirst($element): void
    {
        $newNode = new Node($element);
        $newNode->next = $this->head;
        $this->head = $newNode;
        $this->count++;
    }
    
    public function addLast($element): void
    {
        $newNode = new Node($element);
        
        if ($this->head === null) {
            $this->head = $newNode;
        } else {
            $current = $this->head;
            while ($current->next !== null) {
                $current = $current->next;
            }
            $current->next = $newNode;
        }
        $this->count++;
    }
    
    public function get(int $index)
    {
        if ($index < 0 || $index >= $this->count) {
            throw new OutOfBoundsException("Index $index out of bounds");
        }
        
        $current = $this->head;
        for ($i = 0; $i < $index; $i++) {
            $current = $current->next;
        }
        return $current->data;
    }
    
    public function set(int $index, $element): void
    {
        if ($index < 0 || $index >= $this->count) {
            throw new OutOfBoundsException("Index $index out of bounds");
        }
        
        $current = $this->head;
        for ($i = 0; $i < $index; $i++) {
            $current = $current->next;
        }
        $current->data = $element;
    }
    
    public function remove(int $index): void
    {
        if ($index < 0 || $index >= $this->count) {
            throw new OutOfBoundsException("Index $index out of bounds");
        }
        
        if ($index === 0) {
            $this->head = $this->head->next;
        } else {
            $current = $this->head;
            for ($i = 0; $i < $index - 1; $i++) {
                $current = $current->next;
            }
            $current->next = $current->next->next;
        }
        $this->count--;
    }
    
    public function indexOf($element): int|false
    {
        $current = $this->head;
        $index = 0;
        
        while ($current !== null) {
            if ($current->data === $element) {
                return $index;
            }
            $current = $current->next;
            $index++;
        }
        return false;
    }
    
    public function contains($element): bool
    {
        return $this->indexOf($element) !== false;
    }
    
    public function size(): int
    {
        return $this->count;
    }
    
    public function isEmpty(): bool
    {
        return $this->count === 0;
    }
    
    public function clear(): void
    {
        $this->head = null;
        $this->count = 0;
    }
    
    public function toArray(): array
    {
        $array = [];
        $current = $this->head;
        
        while ($current !== null) {
            $array[] = $current->data;
            $current = $current->next;
        }
        return $array;
    }
}

/**
 * Stack - LIFO (Last In First Out)
 */
class Stack implements StackInterface
{
    private array $elements = [];
    
    public function push($element): void
    {
        $this->elements[] = $element;
    }
    
    public function pop()
    {
        if ($this->isEmpty()) {
            throw new UnderflowException("Stack is empty");
        }
        return array_pop($this->elements);
    }
    
    public function peek()
    {
        if ($this->isEmpty()) {
            throw new UnderflowException("Stack is empty");
        }
        return $this->elements[count($this->elements) - 1];
    }
    
    public function contains($element): bool
    {
        return in_array($element, $this->elements, true);
    }
    
    public function size(): int
    {
        return count($this->elements);
    }
    
    public function isEmpty(): bool
    {
        return empty($this->elements);
    }
    
    public function clear(): void
    {
        $this->elements = [];
    }
    
    public function toArray(): array
    {
        return $this->elements;
    }
}

/**
 * Queue - FIFO (First In First Out)
 */
class Queue implements QueueInterface
{
    private array $elements = [];
    
    public function enqueue($element): void
    {
        $this->elements[] = $element;
    }
    
    public function dequeue()
    {
        if ($this->isEmpty()) {
            throw new UnderflowException("Queue is empty");
        }
        return array_shift($this->elements);
    }
    
    public function peek()
    {
        if ($this->isEmpty()) {
            throw new UnderflowException("Queue is empty");
        }
        return $this->elements[0];
    }
    
    public function contains($element): bool
    {
        return in_array($element, $this->elements, true);
    }
    
    public function size(): int
    {
        return count($this->elements);
    }
    
    public function isEmpty(): bool
    {
        return empty($this->elements);
    }
    
    public function clear(): void
    {
        $this->elements = [];
    }
    
    public function toArray(): array
    {
        return $this->elements;
    }
}

/**
 * HashMap - Penyimpanan key-value pairs
 */
class HashMap implements MapInterface
{
    private array $map = [];
    
    public function put($key, $value): void
    {
        $this->map[$key] = $value;
    }
    
    public function get($key)
    {
        if (!$this->containsKey($key)) {
            throw new OutOfBoundsException("Key '$key' does not exist");
        }
        return $this->map[$key];
    }
    
    public function remove($key): bool
    {
        if ($this->containsKey($key)) {
            unset($this->map[$key]);
            return true;
        }
        return false;
    }
    
    public function containsKey($key): bool
    {
        return array_key_exists($key, $this->map);
    }
    
    public function containsValue($value): bool
    {
        return in_array($value, $this->map, true);
    }
    
    public function keys(): array
    {
        return array_keys($this->map);
    }
    
    public function values(): array
    {
        return array_values($this->map);
    }
    
    public function contains($element): bool
    {
        return $this->containsValue($element);
    }
    
    public function size(): int
    {
        return count($this->map);
    }
    
    public function isEmpty(): bool
    {
        return empty($this->map);
    }
    
    public function clear(): void
    {
        $this->map = [];
    }
    
    public function toArray(): array
    {
        return $this->map;
    }
}

/**
 * CollectionIterator - Iterator untuk collection
 */
class CollectionIterator implements CustomIteratorInterface
{
    private array $elements;
    private int $position = 0;
    
    public function __construct(CollectionInterface $collection)
    {
        $this->elements = $collection->toArray();
    }
    
    public function hasNext(): bool
    {
        return $this->position < count($this->elements);
    }
    
    public function next()
    {
        if (!$this->hasNext()) {
            throw new OutOfBoundsException("No more elements");
        }
        return $this->elements[$this->position++];
    }
    
    public function current()
    {
        if ($this->position >= count($this->elements)) {
            throw new OutOfBoundsException("No current element");
        }
        return $this->elements[$this->position];
    }
    
    public function reset(): void
    {
        $this->position = 0;
    }
}

?>