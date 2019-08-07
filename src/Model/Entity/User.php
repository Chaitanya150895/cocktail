use Cake\Auth\DefaultPasswordHasher;

    protected function _setPassword($password)
    {
        return (new DefaultPasswordHasher)->hash($password);
    }