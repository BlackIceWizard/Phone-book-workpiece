<?php
namespace PhoneBook;

interface IStorage
{
    public function getNewContactInstance(string $name, string $phone) : IContact;

    /**
     * @return IContact[]
     */
    public function readContacts() : array;

    /**
     * @param IContact[] $contacts
     */
    public function storeContacts(array $contacts);
}
