---
How to write doctrine type "phone_number" 
---

### to your Symfony project

Add ```phone_number:  GepurIt\PhoneNumber\PhoneNumberDoctrineType``` to types of dbal in doctrine. See example:

```yaml
# Doctrine Configuration
doctrine:
    dbal:
        default_connection: default
        connections:
            default:     
            some_other:
                
        types:
            phone_number:  GepurIt\PhoneNumber\PhoneNumberDoctrineType

```

SQL type = 'VARCHAR(20)'.

Example of entity:

```php
namespace YourBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;
use GepurIt\PhoneNumber

/** Class EntityWithPhoneField
  * @package YourBundle\Entity
  *
  * @ORM\Table(
  *     name="your_table_name",
  *     options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"}
  * )
  * @ORM\Entity(repositoryClass="YourBundle\Repository\EntityWithPhoneFieldRepository")
  * @ORM\HasLifecycleCallbacks()
  * @codeCoverageIgnore
  */
class EntityWithPhoneField
{
    /**
      * @var PhoneNumber
      *
      * @ORM\Column(name="phone", type="phone_number")
      * @JMS\Expose()
      * @JMS\Groups({"full", "Default"})
      */
    private $phoneNumber;

    /**
     * @return PhoneNumber
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }
    
    /** 
     * @param PhoneNumber $phoneNumber
     */
    public function setPhoneNumber(PhoneNumber $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }
}
```

How to use service PhoneNumberHelper - see example:

```yaml
services:
    phone_number.helper:
        class: GepurIt\PhoneNumber\PhoneNumberHelper
        public: true

```

